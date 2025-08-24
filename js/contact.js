$("#contact-form").submit(function (e) {
    e.preventDefault();
    let mailBody = "";
    $(this).serializeArray().map(function (item) {
        mailBody += `<b>${[item.name]}: </b> ${item.value} <br/>`;
    });

    $.ajax({
        url: "https://www.suncoastship.com/mail/sendMail.php",
        type: "POST",
        dataType: 'json',
        data: { mailBody, sendMail: true },
        success: function (response) {
            if(response.status === "success") {
                showAlert("success", response?.message, "Good job!");
            }
            else {
                showAlert("error", "Something went wrong! Unable to send message!!!", "Oops!");
            }
        },
        error: function (request, status, error) {
            showAlert("success", "Message Send Successfully!!!", "Good job!");
        }
    });
});

const showAlert = (status, message, title) => {
    Swal.fire({
        title: title,
        text: message,
        icon: status
    });
}