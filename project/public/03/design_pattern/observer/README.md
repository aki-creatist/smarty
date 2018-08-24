# Observerパターン

## 概要

* Publish/Subscribe、あるいはpub/subとも呼ばれる
* オブジェクトの状態を観察
    * 変化したときに通知を受けられるようにするパターン
* 2つの役割がある
    * 観察対象
        * Observable、Subject
        * 対応する観察者をいつ更新するかを決める
        * 観察者にどのようなデータをを与えるかを決める
    * 観察者
        * Observer
        * 観察対象の状態が変化したときに通知を受け取る
            * オブジェクトまたは関数
* Javaでは、通知はobserveble.notifyObservers()呼び出しを通じて行う
    * `observeble.notifyObservers()`
        * 1個のオプション引数を取る任意のオブジェクトが使える
        * 観察対象自身を使うことが多い
    * `notifyObservers()`
        * 個々の観察者のupdateメソッドを呼び出す
        * 観察者たちがそれに対して何らかのアクションを取れるようにする

## JavaScriptにおけるObserverパターン

### 目的

* DOMイベントシステムで使用
* ブラウザ内で、`動的UI`を強化する

### 背景

* ブラウザ内では以下のことが行われている
    * DOMイベントハンドラがユーザーの操作を非同期に処理
    * 指定したDOM要素のイベントハンドラとして何らかの関数を登録
        * DOM要素: 観察対象
        * 関数: 観察者

### DOM要素で操作した際の動作

* イベントハンドラが呼び出される
* ユーザーの操作に反応起こす

### ライブサーチ

* 入力フィールドにライブサーチを追加するオブジェクト
    * XMLHttpRequestオブジェクトを使用
    * ユーザーが入力するたびにサーバーサイドサーチをくり返し実行
        * サーチフレーズが長くなるとヒットのリストを短くしていく

### ハンドラの登録

* オブジェクトは、DOMイベントにハンドラを登録しなければならない
    * DOMイベント: キーボード入力によって生成される
    * サーチを実行するタイミングを知るため
* `onreadystatechange`イベントにもハンドラを登録しなければならない
    * onreadystatechangeイベント: XMLHttpRquestオブジェクトに属す
    * HTTP要求を発行できるタイミングを知るため
* サーバーが何らかのサーチ結果を送り返す
* ライブサーチオブジェクトは、アニメーションによって結果ビューを更新する

### コールバックの提供

* オブジェクトはクライアントにカスタムコールバックを提供することもある
    * さらなるカスタマイズを可能にするため
* これらのコールバックは、オブジェクトにハードコード可能
    * 観察者を処理する処理が共通化されていればなおよい

### Observerライブラリ

* 観客者の役割と観察対象の役割を定義する必要がある
    * JavaScriptにおける`観察者`
        * 特定のインターフェイスに適合したオブジェクトである必要はない
    * JSでは関数はオブジェクトであるため関数を直接登録可能
    * そこですべきことは、Observerを定義