// Displays an alert for missing or invalid form fields with error messages.
function showInvalidFieldsErrorAlert(errors) {
    let errorMessages = errors.join("\n");

    Swal.fire({
        title: "Missing or Invalid Fields",
        html: `<pre style="text-align: left; white-space: pre-wrap; word-wrap: break-word; margin-bottom:0;">${errorMessages}</pre>`,
        showConfirmButton: true,
        confirmButtonText: "Close",
        confirmButtonColor: "#d33",
    });

    return;
}

// Shows a success message in a SweetAlert with redirect.
function handleAjaxResponseSuccess(message, redirectUrl = null) {
    Swal.fire({
        icon: "success",
        text: message,
        timer: 5000,
        timerProgressBar: true,
        showConfirmButton: true,
        confirmButtonText: "Close",
        confirmButtonColor: "#28a745",
    }).then(() => {
        if (redirectUrl) {
            window.location.href = redirectUrl;
        } else {
            location.reload();
        }
    });
}

// Displays an error message in a SweetAlert after an Ajax response failure.
function handleAjaxResponseError(message) {
    Swal.fire({
        icon: "error",
        text: message,
        timer: 5000,
        timerProgressBar: true,
        showConfirmButton: true,
        confirmButtonText: "Try Again",
        confirmButtonColor: "#28a745",
    });
}

// Handles general Ajax errors, logs the error, and displays a detailed error message.
function handleAjaxError(xhr, status, error) {
    console.log("Request Failed");
    console.log("Status: " + status);
    console.log("Error: " + error);

    $("#createAppointmentType").modal("hide");

    let errorMessage = "Something went wrong! Please try again.";

    if (xhr.status === 422) {
        errorMessage = "Validation error: " + xhr.responseText;
    } else if (xhr.status === 500) {
        errorMessage = "Server error: " + xhr.responseText;
    } else {
        errorMessage = "Error: " + xhr.statusText;
    }

    Swal.fire({
        icon: "error",
        title: "Error!",
        text: errorMessage,
        timer: 5000,
        timerProgressBar: true,
        showConfirmButton: true,
    });
}

// Helper method to log FormData entries
function logFormData(formData) {
    for (let [key, value] of formData.entries()) {
        console.log(key, " = ", value);
    }
}

// Function to convert time from 24-hour format to 12-hour format with AM/PM
function convertTwelveFormat(time) {
    let [hours, minutes, seconds] = time.split(":");

    hours = parseInt(hours, 10);

    if (hours === 0) {
        return `12:${minutes.padStart(2, "0")} AM`;
    } else if (hours === 12) {
        return `12:${minutes.padStart(2, "0")} PM`;
    } else if (hours < 12) {
        return `${hours.toString().padStart(2, "0")}:${minutes.padStart(
            2,
            "0"
        )} AM`;
    } else {
        hours -= 12;
        return `${hours.toString().padStart(2, "0")}:${minutes.padStart(
            2,
            "0"
        )} PM`;
    }
}
