<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenDate;
use Cake\ORM\Locator\LocatorAwareTrait;

class ReportsController extends AppController
{
    use LocatorAwareTrait;

    public function initialize(): void
    {
        parent::initialize();
        $this->Issued = $this->fetchTable('Issued');
        $this->Returned = $this->fetchTable('Returned');
        $this->Books = $this->fetchTable('Books');

    }

    public function export()
    {
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setOption(
            'pdfConfig',
            [
                'orientation' => 'portrait',
                'download' => true,
                'filename' => 'Library_Reports_' . date('Y-m-d_His') . '.pdf'
            ]
        );

        // Get all the data needed for reports
        $issuedByMonth = $this->Issued->find()
            ->select([
                'month' => 'DATE_FORMAT(issue_date, "%Y-%m")',
                'total' => 'COUNT(*)'
            ])
            ->group('month')
            ->order(['month' => 'ASC'])
            ->all();

        // Prepare data for Bar Chart (Issued)
        $months = [];
        $totals = [];

        foreach ($issuedByMonth as $data) {
            $date = new FrozenDate($data['month'] . '-01');
            $months[] = $date->format('F Y');
            $totals[] = $data['total'];
        }

        // Get returned items grouped by status
        $returnedByStatus = $this->Returned->find()
            ->select([
                'status',
                'count' => 'COUNT(*)'
            ])
            ->group('status')
            ->all();

        // Get books grouped by type
        $booksByType = $this->Books->find()
            ->select([
                'book_type',
                'count' => 'COUNT(*)'
            ])
            ->group('book_type')
            ->order(['book_type' => 'ASC'])
            ->all();

        // Prepare data for Pie/Doughnut Charts
        $statuses = [];
        $statusCounts = [];
        foreach ($returnedByStatus as $data) {
            $statuses[] = $data['status'];
            $statusCounts[] = $data['count'];
        }

        // Prepare data for Books Bar Chart
        $bookTypes = [];
        $bookCounts = [];
        foreach ($booksByType as $data) {
            $bookTypes[] = $data['book_type'] ?: 'Unspecified';
            $bookCounts[] = $data['count'];
        }

        // Get current user and datetime
        $identity = $this->request->getAttribute('identity');
        $currentUser = $identity ? $identity->username : 'veewhaat';
        $currentDateTime = date('Y-m-d H:i:s');

        $this->set(compact('months', 'totals', 'statuses', 'statusCounts', 
                          'bookTypes', 'bookCounts', 'currentUser', 'currentDateTime'));
    }

    public function index()
    {
        // Get filter parameters
    $selectedYear = $this->request->getQuery('year', date('Y'));
    $startDate = $this->request->getQuery('start_date');
    $endDate = $this->request->getQuery('end_date');
    $filterType = $this->request->getQuery('filter_type', 'year'); // default to year filter

    // Get available years for the dropdown
    $availableYears = $this->Issued->find()
        ->select(['year' => 'DISTINCT YEAR(issue_date)'])
        ->order(['year' => 'DESC'])
        ->all()
        ->extract('year')
        ->toArray();

    // Base query for issued items
    $query = $this->Issued->find()
        ->select([
            'month' => 'DATE_FORMAT(issue_date, "%Y-%m")',
            'total' => 'COUNT(*)'
        ]);

    // Apply filters based on selected filter type
    if ($filterType === 'date_range' && $startDate && $endDate) {
        $query->where([
            'issue_date >=' => $startDate,
            'issue_date <=' => $endDate
        ]);
    } else {
        // Default to year filter
        $query->where(['YEAR(issue_date)' => $selectedYear]);
    }

    $issuedByMonth = $query
        ->group('month')
        ->order(['month' => 'ASC'])
        ->all();

    // Prepare data for Bar Chart (Issued)
    $months = [];
    $totals = [];

    // Get Top 5 Most Issued Books
    $topIssuedBooks = $this->Issued->find()
        ->select([
            'book_title',
            'total_issues' => $this->Issued->find()->func()->count('*')
        ])
        ->group('book_title')
        ->order(['total_issues' => 'DESC'])
        ->limit(5)
        ->all();

    // Prepare data for the chart
    $bookTitles = [];
    $issueCounts = [];
    foreach ($topIssuedBooks as $book) {
        $bookTitles[] = $book->book_title;
        $issueCounts[] = $book->total_issues;
    }

    $this->set(compact('bookTitles', 'issueCounts'));

    foreach ($issuedByMonth as $data) {
        $date = new FrozenDate($data['month'] . '-01');
        $months[] = $date->format('F Y');
        $totals[] = $data['total'];
    }


        // Get returned items grouped by status
        $returnedByStatus = $this->Returned->find()
            ->select([
                'status',
                'count' => 'COUNT(*)'
            ])
            ->group('status')
            ->all();

        // Prepare data for Pie/Doughnut Charts
        $statuses = [];
        $statusCounts = [];

        foreach ($returnedByStatus as $data) {
            $statuses[] = $data['status'];
            $statusCounts[] = $data['count'];
        }

        // Get books grouped by type
        $booksByType = $this->Books->find()
            ->select([
                'book_type',
                'count' => 'COUNT(*)'
            ])
            ->group('book_type')
            ->order(['book_type' => 'ASC'])
            ->all();

        // Prepare data for Books Bar Chart
        $bookTypes = [];
        $bookCounts = [];

        foreach ($booksByType as $data) {
            $bookTypes[] = $data['book_type'] ?: 'Unspecified'; // Handle null values
            $bookCounts[] = $data['count'];
        }

         $this->set(compact('months', 'totals', 'statuses', 'statusCounts', 
                       'bookTypes', 'bookCounts', 'availableYears', 
                       'selectedYear', 'startDate', 'endDate', 'filterType'));
    }
    
}