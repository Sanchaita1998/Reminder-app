<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function signup()
    {
        echo view('common/header');
        return view('signup');
        echo view('common/footer');
    }

    public function register()
    {
        // Load the UserModel
        $userModel = new UserModel();
        
        // Get the POST data from the form
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT); // Hash the password
        $membershipDuration = $this->request->getPost('membership_duration');
        
        // Debugging: Check if the membership duration is being received
        echo "Membership Duration: " . $membershipDuration . "<br>";
        
        // Set the current date as the start date
        $startDate = date('Y-m-d');
        
        // Calculate the expiration date based on the selected membership duration
        switch ($membershipDuration) {
            case '3 months':
                $expirationDate = date('Y-m-d', strtotime('+3 months', strtotime($startDate)));
                break;
            case '6 months':
                $expirationDate = date('Y-m-d', strtotime('+6 months', strtotime($startDate)));
                break;
            case '1 year':
                $expirationDate = date('Y-m-d', strtotime('+1 year', strtotime($startDate)));
                break;
            default:
                // Default case, set expiration date as the start date if no valid membership is selected
                $expirationDate = $startDate;
                break;
        }
        
        // Debugging: Check calculated expiration date
        echo "Start Date: " . $startDate . "<br>";
        echo "Expiration Date: " . $expirationDate . "<br>";
        
        // Prepare the member data for insertion
        $memberData = [
            'name'                => $username,
            'email'               => $email,
            'password'            => $password,
            'membership_duration' => $membershipDuration,
            'start_date'          => $startDate,
            'expiration_date'     => $expirationDate
        ];
         
        // // Insert the member data into the database
        if ($userModel->insert($memberData)) {
            // Optionally, you can echo or log success messages for debugging
            echo "Registration successful! Membership valid until: " . $expirationDate;
            
            // Redirect to the login page (or anywhere you want)
            return redirect()->to('login')->with('success', 'Registration successful! Your membership will expire on ' . $expirationDate);
        } else {
            // Handle error if insert fails
            echo "Error: Failed to insert user data!";
        }
    }
    
    



    public function login()
    {
        echo view('common/header');
        return view('login');
        echo view('common/footer');
    }

    public function authenticate()
{
    $userModel = new UserModel();

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Debugging: Check if the email and password are being received correctly
    log_message('debug', "email: " . $email);
    log_message('debug', "password: " . $password);

    $user = $userModel->where('email', $email)->first();

    // Debugging: Check if user data is being fetched correctly
    log_message('debug', "User: " . print_r($user, true));

    if ($user && password_verify($password, $user['password'])) {
        session()->set('isLoggedIn', true);
        session()->set('user', $user);
        return redirect()->to('/dashboard');
    } else {
        return redirect()->to('/login')->with('error', 'Invalid email or password');
    }
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function dashboard(){
        $userModel = new UserModel();

        // Fetch all products from the database
        $data['admin'] = $userModel->findAll();

        // Pass the data to the view
        return view('dashboard', $data);

    }

    



   
    public function sendReminder($encodedEmail)
    {
        // Decode the email parameter
        $email = urldecode($encodedEmail);
        // Load the UserModel and find the user by email
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first(); // Adjusted to fetch by email
    
    
        // Check if expiration date is within 10 days
        $expirationDate = new \DateTime($user['expiration_date']);
        $today = new \DateTime();
        $interval = $today->diff($expirationDate)->days;

        if ($interval <= 10) {
            if ($this->sendEmail($user['email'], $user['name'])) {
                echo '<pre>Email sent successfully to ';
                print_r($user['email']);
                echo '</pre>';
                exit;
            } else {
                echo '<pre>Failed to send email to ';
                print_r($user['email']);
                echo '</pre>';
                exit;
            }
        } else {
            echo '<pre>Reminder can only be sent within 10 days of expiration.</pre>';
            exit;
        }
    }
    
    private function sendEmail($email, $name)
    {
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject("Membership Expiration Reminder");
        $emailService->setMessage("Dear $name, your membership is set to expire soon. Please renew to continue your benefits.");
        
        $result = $emailService->send();
        echo '<pre>Email service result: ';
        var_dump($result);
        echo '</pre>';
        exit;
    
        return $result;
    }
    


}
