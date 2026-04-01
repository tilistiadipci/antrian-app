# API Sederhana

Base URL:

```text
http://192.168.1.116:90/api
```

## 1. Get Counters

- Method: `GET`
- URL: `/get-counters`
- Full URL: `http://192.168.1.116:90/api/get-counters`
- Request parameter: tidak ada

## 2. Get Layanan

- Method: `GET`
- URL: `/get-layanan`
- Full URL: `http://192.168.1.116:90/api/get-layanan`
- Request parameter: tidak ada

## 3. Get Antrian

- Method: `GET`
- URL: `/get-antrian`
- Full URL: `http://192.168.1.116:90/api/get-antrian`
- Request parameter:
  - `layanan_id`

Contoh:

```text
http://192.168.1.116:90/api/get-antrian?layanan_id=1
```

## 4. Next Antrian

- Method: `GET`
- URL: `/next`
- Full URL: `http://192.168.1.116:90/api/next`
- Request parameter:
  - `counter_id`
  - `layanan_id`

Contoh:

```text
http://192.168.1.116:90/api/next?counter_id=1&layanan_id=1
```

## 5. Call Antrian

- Method: `GET`
- URL: `/call`
- Full URL: `http://192.168.1.116:90/api/call`
- Request parameter:
  - `user_id`
  - `counter_id`
  - `layanan_id`

Contoh:

```text
http://192.168.1.116:90/api/call?user_id=1&counter_id=1&layanan_id=1
```

## 6. Recall Antrian

- Method: `GET`
- URL: `/recall`
- Full URL: `http://192.168.1.116:90/api/recall`
- Request parameter:
  - `queue_id`

Contoh:

```text
http://192.168.1.116:90/api/recall?queue_id=1
```
