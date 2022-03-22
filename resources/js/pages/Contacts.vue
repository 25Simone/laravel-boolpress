<template>
    <div>
        <h1>Contacts</h1>
        <form>
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome / Cognome</label>
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
        </form>
    </div>
</template>

<script>
// Axios
import axios from "axios";

export default {
    data() {
        return {
            formData: {
                name: "",
                email: "",
                message: "",
            }
        }
    },
    methods: {
        async formSubmit() {
            const resp = await axios.post("/api/contacts", this.formData);
            console.log(resp.data);
        }
    }
};
</script>

<style lang="scss" scoped></style>
