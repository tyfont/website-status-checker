# **Website Status Checker**

This is a simple PHP-based web application that allows users to check the status of multiple websites and optionally download the content of successful responses.

## **Features**

- Enter multiple domain names (one per line) to check their HTTP status.
- Fetch and save the content of websites returning HTTP 200 status codes.
- Display HTTP status codes for all domains.
- Protects against invalid domain formats and unsafe file naming.
- Built-in client-side form validation and error handling.

## **Requirements**

- PHP 7.4 or higher
- A web server (e.g., Apache, Nginx) with PHP support
- `cURL` PHP extension enabled

## **Installation**

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/tyfont/website-status-checker.git
   cd website-status-checker
   ```

2. **Set Up the `downloads` Directory:**
   Ensure the `downloads` directory exists in the project root. The application will save website content here if the HTTP status is `200`. If the directory doesn't exist, it will be created automatically.

3. **Deploy the Code:**
   - Place the project in the root directory of your web server (e.g., `/var/www/html/website-status-checker`).
   - Access the application in your browser: `http://localhost/website-status-checker`.

## **Usage**

1. Open the application in your browser.
2. Enter a list of domains (one per line) in the provided textarea. For example:
   ```
   example.com
   google.com
   invalid-domain
   ```
3. Click the **Check** button to submit.
4. Results will appear in the "Results" textarea, showing HTTP status codes and any saved file names for successful domains.

## **Directory Structure**

```
project/
│
├── downloads/             # Directory where fetched website content is saved
├── index.php              # Main PHP application
└── README.md              # Documentation
```

## **Security Features**

- **Input Sanitization:** Domains are sanitized and validated before making requests.
- **Safe File Naming:** Ensures downloaded files are named securely and avoids conflicts by appending timestamps.
- **HTML Escaping:** Prevents XSS by escaping output.
- **HTTPS First:** Tries `https://` before falling back to `http://`.

## **Known Limitations**

- Limited timeout for requests (10 seconds). Adjust in the PHP code if needed.
- Heavy usage can result in rate-limiting or blocking by target servers.

## **Customization**

1. **Change the Timeout:**
   Update the `curl_setopt` line:
   ```php
   curl_setopt($curl, CURLOPT_TIMEOUT, 20); // Set timeout to 20 seconds
   ```

2. **Modify Saved File Directory:**
   Update the `$saveDir` variable in `index.php`:
   ```php
   $saveDir = __DIR__ . '/custom-directory/';
   ```

3. **Adjust Error Messages:**
   Modify the `$results` messages in the PHP logic for custom feedback.

## **License**

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## **Contributing**

Contributions are welcome! Feel free to open issues or submit pull requests.
