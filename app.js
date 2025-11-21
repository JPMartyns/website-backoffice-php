// DECLARAR CONSTANTES / VARIAVEIS
const btnSubmit = document.querySelector("#submitBtn");
//btnSubmit.addEventListener("click", validateForm);

const summaryContent = document.querySelector("#summaryContent");

const nameInput = document.querySelector("#name");
const nameSuccess = document.querySelector("#nameSuccess");
const nameError = document.querySelector("#nameError");
nameInput.addEventListener("input", function () {
    validateField("name", this.value.trim(), this, nameError, nameSuccess);
});

const emailInput = document.querySelector("#email");
const emailSuccess = document.querySelector("#emailSuccess");
const emailError = document.querySelector("#emailError");
emailInput.addEventListener("input", function () {
    validateField("email", this.value.trim(), this, emailError, emailSuccess);
});

const phoneInput = document.querySelector("#phone");
const phoneSuccess = document.querySelector("#phoneSuccess");
const phoneError = document.querySelector("#phoneError");
phoneInput.addEventListener("input", function () {
    validateField("phone", this.value.trim(), this, phoneError, phoneSuccess);
});


const messageInput = document.querySelector("#message");
const messageSuccess = document.querySelector("#messageSuccess");
const messageError = document.querySelector("#messageError");
const messageRemaining = document.querySelector("#remaining");
 
messageInput.addEventListener("input", function () {
    validateField("message", this.value.trim(), this, messageError, messageSuccess);
});

const validationRules = {
    name: {
        required: true,
        minLength: 2,
        maxLength: 50,
        pattern: /^[a-zA-ZÀ-ÿ\s]+$/,
        errorMessages: {
            required: "Nome obrigatório",
            minLength: "Mínimo 2 caracteres",
            maxLength: "Máximo 50 caracteres",
            pattern: "Só pode ter letras e espaços",
        },
        successMessage: "Nome válido",
    },
    email: {
        required: true,
        pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        errorMessages: {
            required: "O email é obrigatório",
            pattern: "Formato de email inválido",
        },
        successMessage: "Email válido!",
    },
    phone: {
        required: true,
        pattern: /^[0-9]{9}$/,
        errorMessages: {
            required: "O telefone é obrigatório",
            pattern: "O telefone deve ter exatamente 9 dígitos",
        },
        successMessage: "Telefone válido!",
    },
    
        message: {
        required: true,
        minLength: 10,
        maxLength: 500,
        errorMessages: {
            required: "Mensagem obrigatório",
            minLength: "Mínimo 10 caracteres",
            maxLength: "Máximo 500 caracteres",
        },
        successMessage: "Mensagem válida",
    },
};

// FUNCOES
function showError(errorElement, message) {
    errorElement.innerText = message;
    errorElement.style.display = "block";
}

function hideError(errorElement) {
    errorElement.style.display = "none";
}

function showSuccess(successElement, message) {
    successElement.innerText = message;
    successElement.style.display = "block";
}

function hideSuccess(successElement) {
    successElement.style.display = "none";
}

function setFieldError(input) {
    input.classList.remove("success");
    input.classList.add("error");
}

function setFieldSuccess(input) {
    input.classList.remove("error");
    input.classList.add("success");
}

function validateForm() {
    const fields = [
        {
            name: "name",
            value: nameInput.value.trim(),
            input: nameInput,
            error: nameError,
            success: nameSuccess,
        },
        {
            name: "email",
            value: emailInput.value.trim(),
            input: emailInput,
            error: emailError,
            success: emailSuccess,
        },
        {
            name: "phone",
            value: phoneInput.value.trim(),
            input: phoneInput,
            error: phoneError,
            success: phoneSuccess,
        },
        {
            name: "message",
            value: messageInput.value.trim(),
            input: messageInput,
            error: messageError,
            success: messageSuccess,
        },
    ];

    let isFormValid = true;

    fields.forEach((field) => {
        const isFieldValid = validateField(
            field.name,
            field.value,
            field.input,
            field.error,
            field.success
        );
        if (!isFieldValid) isFormValid = false;
    });

    return isFormValid;
}

function validateField(
    fieldName,
    value,
    inputElement,
    errorElement,
    successElement
) {
    let validation;

    switch (fieldName) {
        case "name":
            validation = validateName(value);
            break;
        case "email":
            validation = validateEmail(value);
            break;
        case "phone":
            validation = validatePhone(value);
            break;
        case "message":
            validation = validateMessage(value);
            break;
    }

    if (!validation.formOk) {
        hideSuccess(successElement);
        showError(errorElement, validation.message);
        setFieldError(inputElement);
    } else {
        hideError(errorElement);
        showSuccess(successElement, validation.message);
        setFieldSuccess(inputElement);
    }

    return validation.formOk;
}

function validateName(value) {
    /*
    if (value == "") {
        console.log("Está vazio e é obrigatório");
    }

    if (value.length < 2 || value.length > 50) {
        console.log("Tem de ter entre 2 e 50 caracteres");
    }

    const pattern = /^[a-zA-ZÀ-ÿ\s]+$/;
    if (!pattern.test(value)) {
        console.log("só aceito letras e espaços");
    }
    */
    /////////////////////////////
    const rules = validationRules.name;

    if (rules.required && value === "") {
        return {formOk: false, message: rules.errorMessages.required};
    }

    if (value.length < rules.minLength) {
        return {formOk: false, message: rules.errorMessages.minLength};
    }

    if (value.length > rules.maxLength) {
        return {formOk: false, message: rules.errorMessages.maxLength};
    }

    if (!rules.pattern.test(value)) {
        return {formOk: false, message: rules.errorMessages.pattern};
    }

    return {formOk: true, message: rules.successMessage};
}

function validateEmail(value) {
    const rules = validationRules.email;

    if (rules.required && value === "") {
        return {formOk: false, message: rules.errorMessages.required};
    }

    if (!rules.pattern.test(value)) {
        return {formOk: false, message: rules.errorMessages.pattern};
    }

    return {formOk: true, message: rules.successMessage};
}

function validatePhone(value) {
    const rules = validationRules.phone;

    if (rules.required && value === "") {
        return {formOk: false, message: rules.errorMessages.required};
    }

    if (!rules.pattern.test(value)) {
        return {formOk: false, message: rules.errorMessages.pattern};
    }

    return {formOk: true, message: rules.successMessage};
}

function validateMessage(value) {
const rules = validationRules.message;

        messageRemaining.innerText = rules.maxLength - value.length;

    if (rules.required && value === "") {
        return {formOk: false, message: rules.errorMessages.required};
    }

    if (value.length < rules.minLength) {
        return {formOk: false, message: rules.errorMessages.minLength};
    }

    if (value.length > rules.maxLength) {
        return {formOk: false, message: rules.errorMessages.maxLength};
    }

    return {formOk: true, message: rules.successMessage};
}

document.querySelector("form").addEventListener("submit", function (event) {
    const isValid = validateForm();

    if (isValid) {
        summaryContent.innerText = "FORM VÁLIDO...PRONTO PARA ENVIAR";
    } else {
        summaryContent.innerText = "FORM INVÁLIDO...CORRIJA";
        const firstFieldError = document.querySelector(".error");
        if (firstFieldError) {
            firstFieldError.focus();
            firstFieldError.parentNode.scrollIntoView();
        }
    }

});