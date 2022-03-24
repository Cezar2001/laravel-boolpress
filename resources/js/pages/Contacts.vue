<template>
    <div class="container mt-5">

        <div v-if="!formSubmitted">
            
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Your name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Inserisci il tuo nome" v-model="formData.name">

                <span class="text-danger" v-if="formErrors && formErrors.name">{{formErrors.name}}</span>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Your Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Inserisci la tua mail" v-model="formData.email">

                <span class="text-danger" v-if="formErrors && formErrors.email">{{formErrors.email}}</span>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Your message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="formData.message"></textarea>

                <span class="text-danger" v-if="formErrors && formErrors.message">{{formErrors.message}}</span>
            </div>

            <div>
                <button type="submit" class="btn btn-primary" @click="formSubmit">Invia</button>
            </div>
            
        </div>

        <div v-else class="alert alert-success py-5 mt-5 text-center">
            <h2>La tua mail è stata inviata correttamente!</h2>
            <p>La preghiamo di rimanere in attesa.</p>
        </div>

    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return {
            formSubmitted: false,
            formData: {
                name: '',
                email: '',
                message: '',
            },
            formErrors: null,
        };
    },
    methods: {
        async formSubmit(){
            try {
                this.formErrors = null;
                const Response = await axios.post('http://127.0.0.1:8000/api/contacts', this.formData);
                Response.data;
                this.formSubmitted = true;
            } 
            catch(error) {
                if(error.response.status === 422) {
                    this.formErrors = error.response.data.errors; 
                }
                alert ('A causa di un errore di server non è stato possibile inviare i suoi dati!');
            }
        }
    },
}
</script>

<style lang="scss" scoped>
</style>