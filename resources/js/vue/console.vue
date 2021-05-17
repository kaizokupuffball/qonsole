<template>
    <div id="console" v-on:click="focus">
        <div id="output" class="output">
        </div>

        <div class="input-wrapper">
            <span class="input-user-host">{{ user }}@{{ host }}:~$</span>
            <input id="input" class="input" type="text" v-on:keyup.enter="run" v-model="command">
        </div>
    </div>
</template>

<script>
export default {

    // User and host props
    // Theese are displayed before the input to simulate a console
    props: {
        user: '',
        host: '',
    },

    // Data object contains the one property of "command"
    data() {
        return {
            command: ''
        }
    },
    
    // All the methods needed for this to work
    methods: {

        // Run a command
        run() {

            // Clear the screen if the cls command is issued
            if (this.command == 'cls') {
                this.cls();
                this.updateInput();
                return;
            }

            // Issue a command from the API
            var apiUrl = '/api/run';
            axios.post(apiUrl, { command: this.command })
            .then((resp) => {

                // Update the output
                this.updateOutput(resp.data);

            })
            .then(() => {

                // Update the input
                this.updateInput();

            });
        },

        // Append issued command response to the output
        updateOutput(resp) {
            var outputElem = document.getElementById('output');
            outputElem.insertAdjacentHTML(
                'beforeend', 
                `<p class="line ${ (resp.success) ? 'success' : 'error' }">
                    <span class="resp-message">${ resp.message }</span>
                    <span class="resp-result">${ resp.result }</span>
                </p>`
            );
        },

        // Clear input and focus
        updateInput() {
            var inputElem = document.getElementById('input');
            inputElem.value = '';
            this.focus();
        },

        // Focus
        focus() {
            var inputElem = document.getElementById('input');
            inputElem.focus();
        },

        // Clear output
        cls() {
            var outputElem = document.getElementById('output');
            outputElem.innerHTML = '';
        }

    }

}
</script>

<style lang="scss">

    $background:#000;
    $textColor:#fff;
    $font:'Segoe UI';
    $fontSize:16px;

    #console {
        background:$background;
        box-sizing:border-box;
        font-family:$font;
        font-size:$fontSize;
        color:$textColor;
        padding:10px;
        min-height:300px;

        .output {

            p {
                display:block;
                margin:0;
                font-size:$fontSize;

                &.error {
                    span {
                        &.resp-message {
                            color:#ff6666;
                        }
                    }
                }

                span {
                    &.resp-message {
                        color:#999;
                    }
                }
            }
        }

        .input-wrapper {
            display:flex;

            .input-user-host {
                margin-right:5px;
                color:#ff66ff;
                font-weight:700;
            }

            input {
                background:$background;
                border:none;
                outline:none;
                box-shadow:none;
                color:$textColor;
                font-family:$font;
                font-size:$fontSize;
            }
        }
    }

</style>