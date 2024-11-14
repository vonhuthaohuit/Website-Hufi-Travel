// Thêm danh sách khách hàng
document
    .getElementById("btn-add-more-customer")
    .addEventListener("click", function () {
        addCustomerRow();
    });
document.querySelector("form").addEventListener("submit", function (event) {
    const input = document.getElementById("td_birthday_1");
    const errorMessage = validateDateInput(input);

    if (errorMessage) {
        event.preventDefault();
        alert(errorMessage);
    }
});

// Hàm thêm hàng khách hàng

function addCustomerRow() {
    var rowTemplate = document.getElementById("customerRowTemplate");

    if (!rowTemplate) {
        console.error("Mẫu hàng không tồn tại!");
        return;
    }

    var newRow = rowTemplate.cloneNode(true);
    newRow.style.display = "";


    setTimeout(function () {
        var index =
            document.querySelectorAll(".add_plus_tr").length + 1;

        newRow.querySelector(
            'input[name="td_ticket[1][td_name]"]'
        ).name = `td_ticket[${index}][td_name]`;
        newRow.querySelector(
            'input[name="td_ticket[1][td_birthday]"]'
        ).name = `td_ticket[${index}][td_birthday]`;
        newRow.querySelector(
            'select[name="td_ticket[1][td_gender]"]'
        ).name = `td_ticket[${index}][td_gender]`;
        newRow.querySelector(
            'select[name="td_ticket[1][td_loaikhach]"]'
        ).name = `td_ticket[${index}][td_loaikhach]`;
        newRow.querySelector(
            'input[name="td_ticket[1][td_price]"]'
        ).name = `td_ticket[${index}][td_price]`;

        // Cập nhật giá trị của các trường khác sau khi tính toán index
        var customerTypeSelect = newRow.querySelector(
            `select[name="td_ticket[${index}][td_loaikhach]"]`
        );

        if (customerTypeSelect && customerTypeSelect.options.length > 0) {
            var defaultPrice =
                customerTypeSelect.options[0].getAttribute("data-price") || "0";

            newRow.querySelector(".js-input-price").value = defaultPrice;
            newRow.querySelector(".td-price").innerText = parseFloat(
                defaultPrice
            ).toLocaleString("vi-VN", { style: "currency", currency: "VND" });

            // Thêm sự kiện change để cập nhật giá khi thay đổi loại khách hàng
            customerTypeSelect.addEventListener("change", function () {
                selectTypeCustomer(customerTypeSelect);
            });
        } else {
            console.error(
                "Không tìm thấy option nào trong select td_loaikhach!"
            );
        }

        // Thêm hàng mới vào bảng
        document.querySelector("#customerTable tbody").appendChild(newRow);
    }, 0); // Đảm bảo việc tính toán index xảy ra sau khi DOM cập nhật
}

function validateNameAndBirthday() {
    var rows = document.querySelectorAll("#customerTable tbody tr");
    var isValid = true;

    rows.forEach(function (row) {
        var name = row.querySelector(
            'input[name^="td_ticket"][name$="[td_name]"]'
        );
        var birthday = row.querySelector(
            'input[name^="td_ticket"][name$="[td_birthday]"]'
        );

        if (!name.value || !birthday.value) {
            isValid = false;
        }
    });

    return isValid; // Return true if both fields are filled in, false otherwise
}

function removeCustomer(element) {
    var row = element.closest("tr");
    row.remove();
}

document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("tour_tep1")
        .addEventListener("click", function (event) {
            event.preventDefault();
            if (validateBookingForm()) {
                document.getElementById("form-booking").submit();
            }
        });

    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    function validateBookingForm() {
        let hasError = false;

        resetErrorMessages();

        hasError = checkRequiredField(
            "ticket_fullname",
            "Trường này là bắt buộc!"
        );
        hasError =
            checkRequiredField("ticket_address", "Trường này là bắt buộc!") ||
            hasError;
        hasError = checkPhoneField("ticket_phone") || hasError;
        hasError = checkEmailField("ticket_email") || hasError;

        return !hasError;
    }

    function checkRequiredField(fieldName, errorMessage) {
        const field = document.querySelector(`input[name="${fieldName}"]`);
        if (!field.value) {
            showError(field, errorMessage);
            return true;
        }
        return false;
    }

    function checkPhoneField(fieldName) {
        const phone = document.querySelector(`input[name="${fieldName}"]`);
        if (!phone.value) {
            showError(phone, "Trường này là bắt buộc!");
            return true;
        } else if (phone.value.length > 10) {
            showError(phone, "Số điện thoại không được quá 10 ký tự!");
            return true;
        } else if (!/^\d+$/.test(phone.value)) {
            showError(phone, "Số điện thoại chỉ được phép nhập số!");
            return true;
        }
        return false;
    }

    function checkEmailField(fieldName) {
        const email = document.querySelector(`input[name="${fieldName}"]`);
        if (!email.value) {
            showError(email, "Trường này là bắt buộc!");
            return true;
        } else if (!validateEmail(email.value)) {
            showError(email, "Email không đúng định dạng!");
            return true;
        }
        return false;
    }

    function showError(field, message) {
        field.classList.add("is-invalid");
        const errorMessage = field.nextElementSibling;
        if (errorMessage) {
            errorMessage.style.display = "block";
            errorMessage.textContent = message;
        }
    }

    function resetErrorMessages() {
        document.querySelectorAll(".error-message").forEach(function (el) {
            el.style.display = "none";
            el.textContent = "";
        });
        document.querySelectorAll("input").forEach(function (input) {
            input.classList.remove("is-invalid");
        });
    }

    document
        .querySelectorAll(
            'input[name="ticket_fullname"], input[name="ticket_address"], input[name="ticket_phone"], input[name="ticket_email"]'
        )
        .forEach((input) => {
            input.addEventListener("input", function () {
                this.classList.remove("is-invalid");
                const errorMessage = this.nextElementSibling;
                errorMessage.style.display = "none";
                errorMessage.textContent = "";
            });
        });

    const phoneInput = document.querySelector('input[name="ticket_phone"]');
    phoneInput.addEventListener("input", function () {
        this.value = this.value.replace(/[^0-9]/g, "").slice(0, 10);
    });
});

function validateDateInput(inputElement) {
    const value = inputElement.value;
    const datePattern = /^\d{2}-\d{2}-\d{4}$/;

    if (!value) {
        return "Trường này là bắt buộc!";
    } else if (!datePattern.test(value)) {
        return "Ngày không hợp lệ!";
    }

    const date = new Date(value);
    if (isNaN(date.getTime())) {
        return "Ngày không hợp lệ!";
    }

    return null;
}
function selectTypeCustomer(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const price = selectedOption.getAttribute("data-price");

    const row = selectElement.closest("tr");
    const priceInput = row.querySelector(".js-input-price");
    const priceDisplay = row.querySelector(".td-price");

    priceInput.value = price;

    // Format the price and display it
    priceDisplay.innerText = new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(price);
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".js-type-customer").forEach((select) => {
        select.addEventListener("change", function () {
            selectTypeCustomer(select);
        });
        selectTypeCustomer(select);
    });
});

function selectTypeCustomer(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const price = selectedOption.getAttribute("data-price") || "0";

    const row = selectElement.closest("tr");
    const priceInput = row.querySelector(".js-input-price");
    const priceDisplay = row.querySelector(".td-price");

    priceInput.value = price;

    // Format the price and display it
    priceDisplay.innerText = new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(price);
}


