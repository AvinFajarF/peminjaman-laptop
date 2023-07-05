
# Peminjaman laptop

project ini untuk peminjaman laptop di sekolah


## Installation

Install my-project with composer

```bash
  git clone https://github.com/AvinFajarF/peminjaman-laptop.git
  cd peminjaman-laptop
  composer install
  php artisan migrate
```
untuk menajalankan project
```bash
  php artisan serve
```
## API Reference



#### register

```http
  POST /api/v1/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | **Required** |
| `password` | `string` | **Required** |
| `email` | `email` | **Required** |
| `number_phone` | `integer` | **Required** |
| `address` | `string` | **Required** |
| `class` | `integer` | **Required** |

#### login

```http
  GET /api/v1/login
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required** |
| `password`      | `string` | **Required** |

<br/>

## User Management 


#### get all user 

```http
  GET /api/v1/dashboard/user
```

#### create

```http
  POST /api/v1/dashboard/user
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | **Required** |
| `password` | `string` | **Required** |
| `email` | `email` | **Required** |
| `number_phone` | `integer` | **Required** |
| `address` | `string` | **Required** |
| `class` | `integer` | **Required** |


#### update user 

```http
  PUT /api/v1/dashboard/user/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | **Optional** |
| `password` | `string` | **Optional** |
| `email` | `email` | **Optional** |
| `number_phone` | `integer` | **Optional** |
| `address` | `string` | **Optional** |
| `class` | `integer` | **Optional** |


#### Delete User

```http
  DELETE /api/v1/dashboard/user/{id}
```

<br/>

## Laptop Management


#### get all laptop 

```http
  GET /api/v1/dashboard/laptop
```

#### create

```http
  POST /api/v1/dashboard/laptop
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `code` | `string` | **Required** |
| `brand` | `string` | **Required** |


#### update laptop 

```http
  PUT /api/v1/dashboard/laptop/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `code` | `string` | **Optional** |
| `brand` | `string` | **Optional** |



#### Delete Laptop

```http
  DELETE /api/v1/dashboard/laptop/{id}
```
<br/>

## Rent Laptop


#### get all rent laptop 

```http
  GET /api/v1/dashboard/laptop/rent
```

#### rent / loan

```http
  POST /api/v1/laptop/rent/loan/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `integer` | **Required** id laptop |


#### update laptop 

```http
  PUT /api/v1/laptop/rent/return/{id}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `integer` | **Optional** id laptop |

