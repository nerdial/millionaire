<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Stat</div>

                    <div class="card-body">

                        <div v-if="totalGames" class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ totalGames }}</h4>
                                <h6 class="card-subtitle mb-2 text-muted">Total Games </h6>
                                <p class="card-text">Times you played game.</p>
                            </div>
                        </div>
                        <div v-if="totalPoints" class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ totalPoints }}</h4>
                                <h6 class="card-subtitle mb-2 text-muted">Total Points</h6>
                                <p class="card-text">This number shows How many points you have got with {{totalGames}} time game .</p>
                            </div>
                        </div>

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
            totalGames: null,
            totalPoints: null
        }
    },
    async mounted() {
        const {data} = await axios.get('api/stat/userStat')
        this.totalGames = data.total_games
        this.totalPoints = data.total_points
    }
}
</script>
