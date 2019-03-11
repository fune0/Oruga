<!doctype html>
<html>

    <body>
        <div id="chat">
            <input type="text" v-model="word">
            <button type="button" @click="onClick">要約検索</button></br>
            <p v-cloak>
                @{{ message }}
            </p>
            <!-- 要約内容 -->
            <span v-text="summaryText"></span></br>
            
            <!-- 関連ワード3つ表示 -->
            <input type="text" v-model="word1"></br>
            <input type="text" v-model="word2"></br>
            <input type="text" v-model="word3"></br>

            <ul>
                <li v-for="item in items" v-cloak>
                    <a v-bind:href="item.url" target="_blank">@{{ item.title }}</a> いいね数: @{{ item.likes_count }}
                </li>
            </ul>

        </div>
        
        
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>

            new Vue({
                el: '#chat',
                data: {
                    word: '',
                    summaryText: '',
                    word1: '',
                    word2: '',
                    word3: '',
                    message: '',
                    items: null
                },
                watch: {
                    word: function(newWord, oldWord){
                        this.message = '入力が終わるのを待ってます･･･';
                        this.debouncedGetAnswer();
                    }
                },
                created: function() {
                    this.debouncedGetAnswer = _.debounce(this.getAnswer, 1000);
                },
                methods: {
                    onClick: function() { //onclickイベント

                        const url = '/ajax/chat_search?'+ [ //ajax通信 (URL)
                            'word='+ this.word
                        ];

                        axios.get(url).then((response) => { //ボタン押されたらデータを返す

                            this.summaryText = response.data.text;
                            this.summarys = response.data;

                            this.word1 = response.data.genre;
                            this.word2 = response.data.genre;
                            this.word3 = response.data.genre;

                        });

                    },
                    getAnswer: function() {
                        // キーワードが空の場合はメッセージと検索結果を空にして処理終了
                            if( this.word === ''){
                            this.items = null;
                            this.message = '';
                            return;
                            }
                    
                            this.message = 'loading...';
                            var vm = this;
                            var params = { page:1, per_page: 10, query: this.word };
                            axios.get('https://qiita.com/api/v2/items', {params})
                            .then(function(response){
                                console.log(response);
                                vm.items = response.data;
                            })
                            .catch(function(error){
                                vm.message = 'Error!' + error;
                            })
                            .finally(function(){
                                vm.message = '';
                            })
                    }
                },
            });

        </script>
    </body>
</html>