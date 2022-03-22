<template>
    <div>
        <h1 class="fw-bold my-3">Contact Us</h1>
        <div v-if="!contactSubmitted && !formSubmittedError">
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
            </div>
            <!-- Button submit-->
            <button @click="formSubmit" type="submit" class="btn btn-success">Invia</button>
        </div>

        <!-- Form's alerts -->
        <div v-if="contactSubmitted" class="alert alert-success py-5">
            <h5>Grazie per averci contattato!</h5>
            <p class="lead">Il suo messaggio è stato inviato correttamente, risponderemo il prima possibile.</p>
        </div>
        <div v-if="formSubmittedError" class="alert alert-danger py-5">
            <h5>Impossibile inviare il Messaggio!</h5>
            <p class="lead">Ci dispiace,  {{errorMessage}} </p>
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
            formData: {
                name: "",
                email: "",
                message: "",
            }
        }
    },
    methods: {
        async formSubmit() {
            try {
                const resp = await axios.post("/api/contacts", this.formData);

                // Alert show
                this.contactSubmitted = true;
            } catch(er) {
                this.errorMessage = er.response.data.message;
                this.formSubmittedError = true;
            }

        }
    },
};
</script>

<style lang="scss" scoped></style>
