<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ header }}</div>
                    <div class="card-body">


                        <div v-if="displayResult & !gameTime" class="alert alert-success" role="alert">
                            Your total point was :  {{ userTotalPoint }} out of {{ totalPoint }}
                        </div>

                        <button v-if="!gameTime" @click="getFreshQuestions" type="button" class="btn btn-primary">
                            Start New Game
                        </button>


                        <div v-if="gameTime">
                            <div v-for="item in options">
                                <input type="radio" :id="item.id" :value="item.id" v-model="selected">
                                <label :for="item.id">{{ item.title }}</label>
                            </div>
                            <br>
                            <div v-if="correctMessage" class="alert alert-success" role="alert">
                                Correct !
                            </div>
                            <div v-if="incorrectMessage" class="alert alert-danger" role="alert">
                                Correct answer is : {{ correctItem.title }} !
                            </div>
                            <button v-if="displayNext" @click="next" type="button"
                                    class="btn btn-primary">Next Question
                            </button>
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
            displayResult: false,
            nextQuestionTimout: 1.5 * 1000,
            totalQuestions: 5,
            totalPoint: 0,
            userTotalPoint: 0,
            currentPoint: 0,
            displayNext: false,
            selected: '',
            correctMessage: false,
            incorrectMessage: false,
            correctItem: null,
            correctAnswer: '',
            options: [],
            questions: [],
            cursor: 0,
            gameTime: false,
            header: '',
            mainHeader: 'Would you like to start a fresh game ?'
        }
    },
    mounted() {
        this.resetHeader()
    },
    methods: {
        async getFreshQuestions() {
            let {data} = await axios.get('api/startNewGame')
            this.startTheGame(data.data)
            this.gameTime = true
        },
        resetHeader() {
            this.header = this.mainHeader
        },
        startTheGame(questions) {
            this.questions = questions
            this.askQuestion(this.cursor)
        },
        resetQuestion() {
            this.correctMessage = false
            this.incorrectMessage = false
            this.displayNext = true
        },
        resetSession() {
            this.userTotalPoint = 0
            this.totalPoint = 0
            this.selected = ''
            this.correctItem = null
        },
        lastQuestion(cursor) {
            return cursor === this.totalQuestions - 1;
        },
        next() {
            this.updateUserPoint();
        },
        correctAnswerSelected() {
            return this.correctItem.id == this.selected;
        },
        updateUserPoint() {
            if (this.correctAnswerSelected()) {
                this.userTotalPoint += this.currentPoint
            }
            this.handleMessage(this.correctAnswerSelected())
        },
        handleMessage(correct) {
            this.displayNext = false
            if (correct) {
                this.correctMessage = true
            } else {
                this.incorrectMessage = true
            }
            setTimeout(() => {
                this.askQuestion(this.cursor)
            }, this.nextQuestionTimout)

        },
        findOption(id) {
            this.options.find(item => item.id == id)
        },
        showResult() {
            this.sendResult()
            this.displayResult = true
            this.gameTime = false
        },
        sendResult() {

        },
        askQuestion(cursor) {
            if (this.lastQuestion(cursor)) {
                this.resetQuestion()
                this.resetHeader()
                return this.showResult()
            }
            this.resetQuestion()
            let question = this.questions[cursor]
            this.cursor++
            this.header = question.title
            this.options = question.options
            this.currentPoint = parseInt(question.point)
            this.correctItem = this.options.find(item => item.is_correct == '1')
            this.totalPoint += this.currentPoint
        },
        calculateTotalPoint() {

        }


    }
}
</script>
