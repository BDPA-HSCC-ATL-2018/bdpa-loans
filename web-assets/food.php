<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="job-applicant-tab" data-toggle="tab" href="#job-applicant" role="tab" aria-controls="job-applicant" aria-selected="true">Applicant Information</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="employment-history-tab" data-toggle="tab" href="#employment-history" role="tab" aria-controls="employment-history" aria-selected="false">Employment History</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="education-history-tab" data-toggle="tab" href="#education-history" role="tab" aria-controls="education-history-tab" aria-selected="false">Education History</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="job-applicant" role="tabpanel" aria-labelledby="job-applicant-tab">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/job-app/forms/applicant.php';?>
  </div>
  <div class="tab-pane fade" id="employment-history" role="tabpanel" aria-labelledby="employment-history-tab">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/job-app/forms/employment_history.php'; ?>
  </div>
  <div class="tab-pane fade" id="education-history" role="tabpanel" aria-labelledby="education-history-tab">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/job-app/forms/education_history.php'; ?>
  </div>
</div>
