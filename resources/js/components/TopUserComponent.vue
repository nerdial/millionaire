<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Top Users</div>

                    <div class="card-body">

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Total Score</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="topUsers" v-for="user in topUsers">
                                <th scope="row">{{user.id}}</th>
                                <td>{{ user.name }}</td>
                                <td>{{user.total}}</td>

                            </tr>
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            topUsers : null,
            counter : 0
        }
    },
    async mounted() {
        this.counter = 1
        const {data} = await axios.get('api/stat/topUsers')
        this.topUsers = data.data.map((item) => {
           return {
               name : item.name,
               total : item.total,
               id : this.counter++
           }
        })

    },
    methods : {
        getCurrentId() {
            this.counter++;
        }
    }

}
</script>
