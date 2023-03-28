
# API Stage Documentation

This API is used to manage student and company data, as well as internships. It provides endpoints to retrieve a list of students, add a student, retrieve a list of companies, add a company, retrieve a list of internships, add an internship.

## Tech

- Symfony 5.4.19;
- PHP 7.4.33;

## Installation

Clone the repository in your web server folder.

```bash
  cd @yourRepository
  composer install
```
- change [.env.sample](.env.sample) to .env ;
- change [api_stage.db.sample](DATA/api_stage.db.sample) to api_stage.db


## API Reference

You can import the file [ApiStage.postman_collection](ApiStage.postman_collection.json) on postman

### Base URL

http://@yourWebServerAdress/ApiStage/public/api/

Put in the header API-KEY a string of 42 characters.

You can generate a random srting here :
https://miniwebtool.com/random-string-generator/

### Endpoints

#### Get list of students

```http
  GET /student
```
Returns a list of all the students.

#### Add a student

```http
  POST /student
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. |
| `first_name` | `string`| **Required**. |
| `picture` | `string` | Link of the student picture. |
| `date_of_birth` | `date`| **Required**. Format : YYYY-MM-DD|
| `grade` | `string` | **Required**. The student grade.|

#### Get list of companies

```http
  GET /company
```
Returns a list of all the companies.

#### Add a company

```http
  POST /company
```

| Parameter | Type    | Description                |
| :-------- | :------- | :-------------------------------- |
| `name` | `string` | **Required**. |
| `street` | `string` | **Required**. |
| `zipcode` | `string` | **Required**. |
| `city` | `string` | **Required**. |
| `website` | `string` | **Required**. Link of the company website.|

#### Get list of internships

```http
  GET /internship
```
Returns a list of all the internships.

#### Add an internship

```http
  POST /internship
```

| Parameter | Type    | Description                |
| :-------- | :------- | :-------------------------------- |
| `id_student` | `int` | **Required**. |
| `id_company` | `int` | **Required**. |
| `start_date` | `date` | **Required**. Format : YYYY-MM-DD |
| `end_date` | `date` | **Required**. Format : YYYY-MM-DD |

## Usage/Examples

Example POST request body for adding a new student:

```json
{
    "name": "Moulin",
    "first_name": "Jean",
    "picture": "https://avatars.githubusercontent.com/u/94854541?v=4",
    "date_of_birth":"1899-07-20",
    "grade": "slam2"
}
```