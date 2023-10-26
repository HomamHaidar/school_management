
# School Management System 🏫

A comprehensive school management system that allows you to control the academic grades, classes, and sections, along with the ability to manage the students and teachers within them. The system will also have multiple levels of permissions for the accounts of parents, students, and teachers, in addition to managing the school's financial matters.


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

