# FetaNa - University Exit Exam Bank

Welcome to **FetaNa**, a comprehensive web application built with **Laravel** for the backend and **Vue.js** for the frontend. This platform serves as a university exit exam bank, allowing users to solve questions and contribute by adding new questions, courses, and programs. FetaNa aims to enhance the learning experience for students preparing for their exit exams.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Introduction

FetaNa is my first project utilizing Vue.js, and I have truly enjoyed the process of building it. Vue's reactivity and simplicity have made development a pleasure, and I particularly appreciate using **Pinia** for state management. This application is designed to provide students with a valuable resource for exam preparation, enabling them to practice with real questions and contribute to a growing database of educational content. 

Please note that this project is ongoing and not yet finished, with new features and improvements being added regularly.

## Features

### User Features
- **Solve Questions**: Users can attempt various questions from different courses and programs.
- **Take Notes**: Users can take notes on specific questions for future reference.
- **Report Mistakes**: Users can report different mistakes found in questions or answers.
- **View Statistics**: Users can see their performance statistics, tracking their progress over time.
- **Contribute Content**: Users can contribute new questions, programs, and courses (admin approval required).

### Admin Features
- **Manage Content**: Admins can manage questions, courses, and programs within the platform.
- **Review Contributions**: Admins can review user contributions and reports to ensure quality and accuracy.

## Technologies Used

- **Backend**: Laravel
- **Frontend**: Vue.js
- **State Management**: Pinia
- **Database**: Mysqlite


## Installation

To get started with FetaNa, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/fetana.git
   ```

2. Navigate to the project directory:
   ```bash
   cd fetana
   ```

3. Install backend dependencies:
   ```bash
   cd server
   composer install
   ```

4. Set up your environment variables:
   - Copy `.env.example` to `.env` and configure your database settings.

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Install frontend dependencies:
   ```bash
   cd ../client
   npm install
   ```

8. Start the development server:
   - For Laravel (backend):
     ```bash
     php artisan serve
     ```
   - For Vue (frontend):
     ```bash
     npm run serve
     ```

## Usage

Once the application is running, you can access it via your web browser at `http://localhost:8000` (or the port specified by Laravel). Users can register, log in, solve questions, take notes, report mistakes, view their statistics, and contribute new content to the exam bank.

## Contributing

I welcome contributions from the community! If you would like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Make your changes and commit them (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Open a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

Thank you for checking out FetaNa! I hope it serves as a valuable tool for students preparing for their university exit exams. If you have any questions or feedback, feel free to reach out and call!
