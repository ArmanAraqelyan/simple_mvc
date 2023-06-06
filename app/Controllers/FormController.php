<?php

namespace App\Controllers;

use App\Models\DataService;
use App\Services\EmailSender;
use App\Services\SMSSender;

class FormController
{
    private DataService $dataService;
    private EmailSender $emailSender;
    private SMSSender $smsSender;

    public function __construct(
        DataService $dataService,
        EmailSender $emailSender,
        SMSSender $smsSender
    )
    {
        $this->dataService = $dataService;
        $this->emailSender = $emailSender;
        $this->smsSender = $smsSender;
    }

    public function index(): void
    {
        require_once __DIR__ . '/../Views/form.php';
    }

    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data'];

            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

            $id = $this->dataService->insertData($data);

            // getting the inserted data
            $result = $this->dataService->getData($id);

            require_once __DIR__ . '/../Views/result.php';

            $this->emailSender->sendEmail($data);
            $this->smsSender->sendSMS($data);
        }
    }
}
