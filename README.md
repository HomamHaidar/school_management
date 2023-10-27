
# School Management System 🏫

A comprehensive school management system that allows you to control the academic grades, classes, and sections, along with the ability to manage the students and teachers within them. The system will also have multiple levels of permissions for the accounts of parents, students, and teachers, in addition to managing the school's financial matters.

![image_2023-10-27_07-55-36](https://github.com/HomamHaidar/school_management/assets/147708704/345b2ff6-9a7b-4548-bcfd-36bec03d7e7e)
![image_2023-10-27_08-04-16](https://github.com/HomamHaidar/school_management/assets/147708704/abb08ad2-dbee-4127-9b98-047aea108be4)
![image_2023-10-27_08-04-13](https://github.com/HomamHaidar/school_management/assets/147708704/2c3b0bc8-a431-4dab-91a7-72fd787f2882)
![image_2023-10-27_08-03-54](https://github.com/HomamHaidar/school_management/assets/147708704/6d2445e0-0b78-4bd3-a30b-9c03e377e693)
![image_2023-10-27_08-03-47](https://github.com/HomamHaidar/school_management/assets/147708704/b3735e2e-b669-400a-90ef-abe2fbc4efcb)
![image_2023-10-27_08-03-41](https://github.com/HomamHaidar/school_management/assets/147708704/1869563e-4636-4278-a54f-f01e7cd65e99)
![image_2023-10-27_08-03-32](https://github.com/HomamHaidar/school_management/assets/147708704/c8783f0e-dce1-4703-89f6-15a1acb85cdd)
![image_2023-10-27_07-57-40](https://github.com/HomamHaidar/school_management/assets/147708704/ff82825c-bf73-49a5-8db1-d6293da53343)
![image_2023-10-27_07-57-17](https://github.com/HomamHaidar/school_management/assets/147708704/2075a5fd-8cab-4f0d-9ee6-deccbbb82a7a)

## Features
- EN/AR 🌐
- Fullscreen mode 🖥
- Determine the number of academic stages in your school, in addition to the currently active classes 📖
- You can track your students exam grades, attendance days, and send reports to their parents through their accounts on the system.👨‍👩‍👧‍👦
- You can handle fee management, including receipt transactions, cash refunds, and all matters related to the school's treasury 💲
- Your teachers can create automated test questions, and the results will be automatically generated and issued to the students immediately after the exam ends ⁉️ 💯
- You can add the college's private library that contains all the books uploaded by you 📚
## Installation

> **Warning**
> Make sure to follow the requirements first.

Here is how you can run the project locally:
1. Clone this repo
    ```sh
    git clone git@github.com:HomamHaidar/school_management.git
    ```

1. Go into the project root directory
    ```sh
    cd  school_management
    ```

1. Copy .env.example file to .env file
    ```sh
    cp .env.example .env
    ```
1. Create database `school` (you can change database name)

1. Install PHP dependencies 
    ```sh
    composer install
    ```

1. Generate key 
    ```sh
    php artisan key:generate
    ```


1. Run migration
    ```
    php artisan migrate
    ```
    
1. Run seeder
    ```
    php artisan db:seed
    ```
  
1. Run server 

   
    ```sh
    php artisan serve
    ```  
Visit localhost:8000 in your favorite browser.

