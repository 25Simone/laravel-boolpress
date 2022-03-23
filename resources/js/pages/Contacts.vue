<template>
    <div>
        <h1 class="fw-bold my-3">Contact Us</h1>
        <!-- Form errors alert -->
        <div v-if="formSubmittedError" class="alert alert-danger py-5">
            <h5>Impossibile inviare il Messaggio!</h5>
            <p class="lead">Ci dispiace,  {{errorMessage}} </p>
        </div>

        <!-- Form -->
        <div v-if="!contactSubmitted">
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome e Cognome</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    placeholder="Enter the Name"
                    v-model="formData.name"
                />
                <span class="text-danger" v-if="formValidationErrors && formValidationErrors.name"> {{formValidationErrors.name}} </span>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Indirizzo Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="exampleFormControlInput1"
                    placeholder="name@example.com"
                    v-model="formData.email"
                />
                <span class="text-danger" v-if="formValidationErrors && formValidationErrors.email"> {{formValidationErrors.email}} </span>
            </div>
            <!-- Message -->
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Messaggio</label>
                <textarea
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
                    v-model="formData.message"
                ></textarea>
                <span class="text-danger" v-if="formValidationErrors && formValidationErrors.message"> {{formValidationErrors.message}} </span>
            </div>
            <!-- Attachment -->
            <div class="mb-3">
                <label for="attachmentInput" class="form-label">Allegato</label>
                <input
                    type="file"
                    class="form-control"
                    id="attachmentInput"
                    @change="onAttachmentChange"
                />
                <span class="text-danger" v-if="formValidationErrors && formValidationErrors.attachment"> {{formValidationErrors.attachment}} </span>
            </div>
            <!-- Button submit-->
            <button @click="formSubmit" type="submit" class="btn btn-success">Invia</button>
        </div>

        <!-- Alert sending successfully -->
        <div v-if="contactSubmitted" class="alert alert-success py-5">
            <h5>Grazie per averci contattato!</h5>
            <p class="lead">Il suo messaggio è stato inviato correttamente, risponderemo il prima possibile.</p>
        </div>
    </div>
</template>

<script>
// Axios
import axios from "axios";

export default {
    data() {
        return {
            contactSubmitted: false,
            formSubmittedError: false,
            errorMessage: null,
            formValidationErrors: null,
            formData: {
                name: "",
                email: "",
                message: "",
                attachment: null,
            }
        }
    },
    methods: {
        async formSubmit() {
            try {
                // Reset formValidationErrors
                this.formValidationErrors = null;

                // Create an instance of FormData class
                const formDataInstance = new FormData();
                // Pass manually the keys and the values to the instance
                formDataInstance.append("name", this.formData.name);
                formDataInstance.append("email", this.formData.email);
                formDataInstance.append("message", this.formData.message);
                formDataInstance.append("attachment", this.formData.attachment);

                // Axios post
                const resp = await axios.post("/api/contacts", formDataInstance);

                // Alert show
                this.contactSubmitted = true;
                this.formSubmittedError = false;
            } catch(er) {
                this.errorMessage = er.response.data.message;
                this.formSubmittedError = true;
                // 422 is a validation error
                if (er.response.status === 422) {
                    this.formValidationErrors = er.response.data.errors;
                }
            }

        },
        onAttachmentChange(event) {
            // Save in the form data the attachment file
            this.formData.attachment = event.target.files[0];
        }
    },
};
</script>

<style lang="scss" scoped></style>
