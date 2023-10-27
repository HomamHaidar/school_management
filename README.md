
# School Management System 🏫

A comprehensive school management system that allows you to control the academic grades, classes, and sections, along with the ability to manage the students and teachers within them. The system will also have multiple levels of permissions for the accounts of parents, students, and teachers, in addition to managing the school's financial matters.

![image_2023-10-27_07-55-36](https://github.com/HomamHaidar/school_management/assets/147708704/345b2ff6-9a7b-4548-bcfd-36bec03d7e7e)
![image_2023-10-27_07-57-17](https://github.com/HomamHaidar/school_management/assets/147708704/6274ffad-d911-4b0a-8d7c-de96089306f4)
![image_2023-10-27_07-57-40](https://github.com/HomamHaidar/school_management/assets/147708704/9b00fabb-3935-4d49-bbd5-2bba123d1c65)
![image_2023-10-27_08-03-32](https://github.com/HomamHaidar/school_management/assets/147708704/6fc1a819-268b-4393-ae14-d49a0de62291)
![image_2023-10-27_08-03-41](https://github.com/HomamHaidar/school_management/assets/147708704/78608c8e-b811-4d90-8d89-f5d75318e9e5)
![image_2023-10-27_08-03-47](https://github.com/HomamHaidar/school_management/assets/147708704/176454ff-d287-4bd6-8700-6c2ad2ee6497)
![image_2023-10-27_08-03-54](https://github.com/HomamHaidar/school_management/assets/147708704/480c615c-384d-487a-9c54-cbd80d61cb23)
![image_2023-10-27_08-04-13](https://github.com/HomamHaidar/school_management/assets/147708704/74b18f75-e86d-4fbc-a20e-fafce41513d5)
![image_2023-10-27_08-04-16](https://github.com/HomamHaidar/school_management/assets/147708704/4b536ae5-175e-4261-a9b0-bc9e1cbe05e2)


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
      this command will create  user (admin) and  configure the settings :
     > email: homamhaidar18@gmail.com , password: 12345678

  
1. Run server 

   
    ```sh
    php artisan serve
    ```  
Visit localhost:8000 in your favorite browser.

