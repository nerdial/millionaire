<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Would you like to start a fresh game ?</div>
                    <div class="card-body">
                        <button @click="startNewGame" type="button" class="btn btn-primary">Start</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        methods : {
            startNewGame(){

                axios.get('api/startNewGame').then(data=> {
                    console.log(data)
                })

            }
        }
    }
</script>
