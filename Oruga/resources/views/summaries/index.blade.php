<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Oruga-Bot</title>
  <link rel="stylesheet" href="css/style.css">
</head>

    <body>
      <div class="chat" id="chat">
        <!-- 入力した単語出力 -->
        <div class="user-area">
          <ul class="output-list" style="list-style: none;">
            <li v-for="aaa in aaas" style="text-align:right">
                <span>@{{ aaa }}</span>
            </li>
          </ul>
        </div>
        <!-- bot出力 -->
        <div class="response-area">
          <ul class="summaries-list">
            <!-- 単語に対する要約出力 -->
            <li v-for="bbb in bbbs">
                <span>@{{ bbb }}</span>
            </li>
            <!-- QiitaAPI表示 -->
            <!-- <li v-for="item in items">
                <a v-bind:href="item.url">@{{ item.title }}</a>
            </li> -->
            <!-- ジャンル別単語のランダム表示 -->
            <!-- <li>
            </li> -->
          </ul>
        </div>
        <!-- 入力フォーム -->
        <div class="chatbox-area">
          <form action="" id="chatform" name="form">
            <input type="text" name="word" v-model="word">
            <input type="button" value="要約検索" @click="onClick"></button></br>
          </form>
        </div>
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
                  aaas: [],
                  bbbs: []
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
                          var bbb = this.summaryText;
                          this.bbbs.push(bbb);

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
