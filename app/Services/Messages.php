<?php 

namespace App\Services;

class Messages {
    public string $successGetMessage = 'Success Get Data';
    public string $failedGetMessage = 'Failed Get Data';
    public string $successCreateMessage = 'Success Create Data';
    public string $failedCreateMessage = 'Failed Create Data';
    public string $successUpdateMessage = 'Success Update Data';
    public string $failedUpdateMessage = 'Failed Update Data';
    public string $successDeleteMessage = 'Success Delete Data';
    public string $failedDeleteMessage = 'Failed Delete Data';
    public string $successDownloadMessage = 'Success Download Data';
    public string $failedDownloadMessage = 'Failed Delete Data';
    public string $notFoundMessage = 'Data Not Found';
    public array $successApproveMessage = [
        'reject' => 'Success Reject Data',
        'approve' => 'Success Approve Data',
        -1 => 'Success Reject Data',
        1 => 'Success Approve Data'
    ];
    public array $failedApproveMessage = [
        'reject' => 'Failed Reject Data',
        'approve' => 'Failed Approve Data',
        -1 => 'Failed Reject Data',
        1 => 'Failed Approve Data'
    ];
    public array $successActiveMessage = [
        0 => 'Success Nonactive Data',
        1 => 'Success Active Data'
    ];
    public array $failedActiveMessage = [
        0 => 'Failed Nonactive Data',
        1 => 'Failed Active Data'
    ];

    public array $statusApproval = [
        0 => 'Waiting Approval',
        1 => 'Approved',
        -1 => 'Rejected',
    ];
}

 ?>