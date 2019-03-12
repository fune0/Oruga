<!doctype html>
<html>
    <body>

        <div id="chat">

            <!-- 入力した単語出力 -->
            <ul style="list-style: none;">
                <li v-for="aaa in aaas">
                    <span>@{{ aaa }}</span>
                </li>
            </ul>
             
        <span v-text="summaryText"></span></br>

        <!-- QiitaAPI表示 -->
            <ul style="list-style: none;">
                <li v-for="item in items">
                    <a v-bind:href="item.url">@{{ item.title}}</a>
                </li>
            </ul>

            <input type="text" v-model="word">
            <button type="button" @click="onClick">要約検索</button></br>


            

        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <script>

            new Vue({
                el: '#chat',
                data: {
                    word: '',
                    summaryText: '',
                    items: null,
                    aaas: []
                },
                methods: {
                    onClick: function() { //onclickイベント

                        const url = '/ajax/chat_search?'+ [ //ajax通信 (URL)
                            'word='+ this.word
                        ];

                        var aaa = this.word;
                        this.aaas.push(aaa);

                        axios.get(url).then((response) => { //ボタン押されたらデータを返す
                            this.summaryText = response.data.text;
                        });
                        
                        var params = { page:1, per_page: 1, query: this.word };
                        axios.get('https://qiita.com/api/v2/items', {params}).then((response) => {
                            console.log(response);
                            this.items = response.data;
                        });
 
                    },
                    /*
                    getAnswer: function(){
                        // キーワードが空の場合はメッセージと検索結果を空にして処理終了
                        if( this.word === ''){
                        this.items = null;
                        return;
                        }
                
                        var vm = this;
                        var params = { page:1, per_page: 3, query: this.word };
                        axios.get('https://qiita.com/api/v2/items', {params})
                        .then(function(response){
                            console.log(response);
                            vm.items = response.data;
                        })
                        .catch(function(error){
                            console.log('error!') + error;
                        })
                        .finally(function(){
                            console.log('!');
                        })
                
                    },
                    */
                },
            });

        </script>
    </body>
</html>