# PHPMailer Email Sender

This is a simple PHP application that allows users to send emails using PHPMailer with SMTP authentication. Users can input their own email credentials, recipient email address, and other details through a web form.

## Prerequisites

- [Docker](https://www.docker.com/) installed on your machine.

## Getting Started

1. **Clone the repository to your local machine.**

   ```bash
   git clone https://github.com/bugkerb/phpmailer-email-sender.git
   ```

2. **Navigate to the project directory.**

   ```bash
   cd phpmailer-email-sender
   ```

3. **Build and run the Docker container.**

   ```bash
   docker-compose up
   ```

4. **Access the application in your web browser.**
   ```url
   http://localhost:8080
   ```

## Usage

1. Open the web application in your browser.

2. Fill in the required information in the form:

   - **To Email:** Enter the recipient's email address.
   - **SMTP Host:** Enter the SMTP server host.
   - **SMTP Username:** Enter the SMTP username.
   - **SMTP Password:** Enter the SMTP password.

3. Click the "Send Email" button to send a test email.

## Configuration

- Update the PHPMailer dependencies using Composer.
  ```bash
  docker-compose exec phpmailer-app composer install
  ```
- Customize the PHP code and form as needed for your specific use case.

## Notes

- Ensure that the provided SMTP credentials are valid and have the necessary permissions to send emails.

- Modify the docker-compose.yml file or environment variables as needed for your deployment.

## Contributing

Feel free to contribute to the project by opening issues or submitting pull requests. Any feedback or improvements are appreciated!

## License

This project is licensed under the MIT License.
