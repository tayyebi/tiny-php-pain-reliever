<a class="profile-edit-btn background-dark color-white border-radius" href="<?php echo $Data['FeedbackUrl']?>">بازگشت</a>
<h1>بازخورد / گزارش شما برای ما ارزشمند است و ما حتما آن‌را بررسی خواهیم کرد.</h1>
<?php echo isset($Data['FeedbackTitle']) ? '<h2>' . $Data['FeedbackTitle'] . '</h2>' : '' ?>

<script>
    var feedbackForm = document.getElementById("Feedback");
    feedbackForm.style.display = "block";
</script>