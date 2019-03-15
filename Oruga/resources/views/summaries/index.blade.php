<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Oruga</title>
    <link rel="stylesheet" href="https://unpkg.com/botui/build/botui.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/botui/build/botui-theme-default.css" />
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>

    <div class="botui-app-container" id="bot">
      <bot-ui></bot-ui>
    </div>

    <script src="https://cdn.jsdelivr.net/vue/latest/vue.min.js"></script>
    <script src="https://unpkg.com/botui/build/botui.min.js"></script>
    <script>

    data = @json($lists);
    console.log(data);

    /* var genreData = data.filter(function(item, index) {
        if (item.genre == "PHP") return true;
    });
    console.log(genreData); */

    /* var wordData = genreData.filter(function(item, index){
        if (item.word == "Laravel") return true;
    });
    console.log(wordData); */

    const botui = new BotUI('bot');

    botui.message.bot({
      delay: 200,
      content: 'こんにちは！ Orugaだよ！',
      loading: true
    }).then(init);


    function init(){
      botui.message.bot({
        delay: 800,
        content: 'ジャンルを選んで',
        loading: true
      }).then(() => {
        return botui.message.bot({
          delay: 500,
          loading: true,
          content: 'わからない単語を入力してね！'
        }).then(() => {
          return botui.action.button({
            delay: 300,
            action: [{
              text: 'PHP',
              value: 'PHP'
            },{
              text: 'Ruby',
              value: 'Ruby'
            },{
              text: 'Python',
              value: 'Python'
            }]
          });
        }).then(res => {
          genreData = data.filter(function(item, index) { //ジャンルデータに絞り込み
            if (item.genre == res.text) return true;
          });
          console.log(genreData);
            return botui.message.bot({
              delay: 400,
              loading: true,
              content: 'ジャンルは ' + res.text + 'だね!'
            });
        }).then(() => {
          botui.message.bot({
            delay: 700,
            loading: true,
            content: 'わからない単語を教えて ?'
          }).then(function () {
            return botui.action.text({
              delay: 400,
              action: {
                size: 18,
                icon: 'user-circle-o',
                sub_type: 'text',
                placeholder: '単語で入力'
              }
            });
          }).then(res => {
            name = res.value; // ユーザーの入力値
            wordData = genreData.filter(function(item, index){
              // if (item.word == name){
              //   return true
              // }else{
              //   return falseword();
              // }
              if(item.word == name) return true;
            });
            console.log(wordData);

            if (wordData[0] == null){

              falseword();

            }else{

              botui.message.bot({
                delay: 300,
                loading: true,
                content: wordData[0].text
              });

              // キータAPI出力ゾーン

              botui.message.bot({
                delay: 300,
                loading: true,
                content: wordData[1].text
              });

              // キータAPI出力ゾーン終わり


              // ジャンル別３個選出ゾーン
              botui.message.bot({
                delay: 300,
                loading: true,
                content: wordData[1].text
              });

              botui.message.bot({
                delay: 300,
                loading: true,
                content: wordData[1].text
              });

              botui.message.bot({
                delay: 300,
                loading: true,
                content: wordData[1].text
              });
              // ジャンル別３個選出ゾーン終わり




              botui.message.bot({
                delay: 300,
                loading: true,
                content: wordData[0].text
              }).then(function() {
                return botui.message.bot({
                delay: 300,
                content: '続けて検索しますか？'
                })
              }).then(function() {
                  //「はい」「いいえ」のボタンを表示
                  return botui.action.button({
                      delay: 300,
                      action: [{
                        icon: 'circle-thin',
                        text: 'はい',
                        value: true
                      }, {
                        icon: 'close',
                        text: 'いいえ',
                        value: false
                      }]
                  });
              }).then(function(res) {
              res.value ? init() : end();
              });
            }
          });
        });
      });
    }



    function falseword() {
      botui.message.bot({
        delay: 200,
        content: 'すいません、要約がありません',
        loading: true
      }).then(init);
    }



    function end() {
      botui.message.bot({
        delay: 200,
        content: 'ありがとうございました',
        loading: true
      });
    }



    </script>
  </body>
</html>
