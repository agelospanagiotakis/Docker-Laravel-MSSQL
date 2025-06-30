# PHP Laravel project with sql server 2008
to store and access medical data from a hospital database

# Database schema description   
The database schema consists of the following main tables:

## Patients
- ID (Primary Key)
- FirstName
- LastName
- PatientAge

## Admissions
- ID (Primary Key)
- PatientID (Foreign Key to Patients)
- AdmissionDate
- DischargeDate
- DiagnosisID (Foreign Key to Diagnoses)

## Surgeries
- ID (Primary Key)
- AdmissionID (Foreign Key to Admissions)
- DatePerformed
- SurgeonID (Foreign Key to Doctors)
- AnesthesiologistID (Foreign Key to Doctors)
- AssistantID (Foreign Key to Doctors)
- ProcedureID (Foreign Key to Procedures)

## Doctors
- ID (Primary Key)
- FirstName
- LastName
- Specialty
- Title

## Diagnoses
- ID (Primary Key)
- Name
- Description

## Procedures
- ID (Primary Key)
- Name
- Description

## Lookup Tables
ID	Code	Description
1	Istologika	Ιστολογική
2	Operation 	Επέμβαση
3	Access    	Προσπέλαση
4	Anesthisia	Είδος Αναισθησίας
5	Profession	Επάγγελμα
6	Nation    	Εθνικότητα
7	Education 	Εκπαίδευση
8	Insurance 	Ασφάλιση
9	SMark     	Ενδειξη Επεμβάσεων
10	Room      	Δωμάτιο
11	Diagnosis 	Διάγνωση
12	Result    	Εκβαση
13	Illness   	Κατηγορία Νόσου
14	Localiz   	Εντόπιση
15	Prefecture	Νομός
16	Specialize	Ιατρική Ειδικότητα
17	Country   	Χώρα

This schema allows for tracking patients, their hospital admissions, surgeries performed, doctors involved, diagnoses, and histological exam results. The relationships between tables are maintained through foreign key constraints.


# tech stack
Laravel 11 + eloquent + blade 
php 8.2
pdf library  https://github.com/dompdf/dompdf
SQL Server Driver for PHP
# todo on tech stack

add ui/shadcn https://ui.shadcn.com/docs/components/form ?


# Server setup 

## instal sql server 2008

 https://www.daktronics.com/en-us/support/kb/DD3400198

## Install SQL Server Driver for PHP

extension=php_sqlsrv_82_ts_x64.dll
extension=php_pdo_sqlsrv_82_ts_x64.dll
 

## setup mssql connection

DB_CONNECTION=sqlsrv
DB_HOST=127.0.0.1
DB_PORT=1433
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

set config/database.php
'connections' => [
    'sqlsrv' => [
        'driver' => 'sqlsrv',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '1433'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8',
        'prefix' => '',
    ],
],


```
 php artisan migrate
php artisan serve

```



https://www.microsoft.com/en-us/download/details.aspx?id=30438


Dsn=mssql-db;uid=agelos;trusted_connection=Yes;app=dbForge for MySQL;wsid=DESKTOP-VJQPTFT;database=test



Νοσηλευομενοι: 
Αρ.Εισαγωγών:  
Αρ.Επεμβάσεων:  
Αρ.Ασθενών:  



# Todo 
other patient data from Lookup/LookupType table
print footer on printed pages
test laravel PowerGrid https://livewire-powergrid.com/get-started/introduction.html!


user - roles 
```
 Select [RoleID] ,[UserID] from  [UsersInRole]
```

doctor - roles
```
SELECT [Role] from [Doctor]
SELECT [RoleName] [Description] FROM [Role]
```
Visit to doctor 
statistics


other lookup types and lookup fields to explore ?
more patient info to explore ?
better pdf printing on footer 
http://localhost:8000/admissions - speed issue
protect sensitive patient records from unauthorized access from certain roles 

Explore tables : 
1) Visit
2) Patient_DEL
3) User/UsersInRole and Doctors / Roles
4) NX_EKTOS_F1_WORK
```
SELECT       
        [id],
        [PRGID]
      ,[PRSID]
      ,[F4]
      ,[PATIENTNAME]
      ,[PATIENTID]
      ,[HIS]
      ,[AGE]
      ,[NOSOS]
      ,[SURGERY1]
      ,[DOCTOR_ID]
      ,[PATIENT_ID]
  FROM .[NX_EKTOS_F1_WORK]
```
5) NXF1_WORK
```
SELECT [Ονοματεπώνυμο]
      ,[ΑΜΚΑ]
      ,[Ημέρ#  Νοσ#]
      ,[Ημ/νία  Εισαγωγής]
      ,[Ημ/νία  Εξιτηρίου]
      ,[Διαγνώσεις Εξόδου]
      ,[Birthday]
      ,[BirthYear]
      ,[id]
      ,[LastName]
      ,[FirstName]
  FROM [NXF1_WORK]
```
6) Logging/jobs/failed_jobs

https://ui.shadcn.com/docs/components/form

# find libs

https://laraveldaily.com/packages


# tests

http://localhost:8000/patients/37212#
http://localhost:8000/patients/15836
http://localhost:8000/patients/15614


# resources 

https://tailwindcss.com/

# read more 
laravel livewire tutorial

queries  
https://www.youtube.com/watch?v=dYWpfB8IeVk&list=PLkyrdyGDWthC-yd9n8R3CEauJC4sFl-kj&index=10

https://laracasts.com/series/understanding-laravels-context-capabilities
