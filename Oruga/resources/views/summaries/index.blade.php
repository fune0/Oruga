<!doctype html>
<html>
  
    <body>
        <div id="chat">
            <input type="text" v-model="word">&nbsp;
            <button type="button" @click="onClick">要約検索</button>
            <!-- 要約内容 -->
            <input type="text" v-model="summaryText">
        </div>
        
        
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script>

            new Vue({
                el: '#chat',
                data: {
                    word: '',
                    summaryText: ''
                },
                methods: {
                    onClick: function() { //onclickイベント

                        const url = '/ajax/chat_search?'+ [ //ajax通信 (URL)
                            'word='+ this.word
                        ];

                        axios.get(url).then((response) => { //ボタン押されたらデータを返す

                            this.summaryText = response.data.text;

                        });

                    }
                }
            });

        </script>
    </body>
</html>