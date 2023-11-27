# 勤怠管理システム
出勤、退勤、休憩時間を管理できるシステム。

## 作成目的
初級模擬テストのため

## アプリケーションURL
https://github.com/naoki28aida/stest.git

最初に会員登録しないとログインできません。

## 機能一覧
・新規ユーザー登録機能

・メール認証、および再送機能

・ログイン、ログアウト機能

・パスワード再設定機能

・出勤、退勤、休憩時間管理機能

・在籍ユーザー一覧、日付、月別の出勤確認機能

## 仕様技術
Laravel8.83.27、PHP、mysql、phpmyadmin、mailhog

## テーブル設計
<img width="280" alt="table" src="https://github.com/naoki28aida/stest/assets/138663818/dd74455e-e7d0-49fc-8f09-62d65bccf27d">

## ER図
<img width="339" alt="ER" src="https://github.com/naoki28aida/stest/assets/138663818/879690f5-f375-41ba-8f72-380b13dec1e0">

# 環境構築
<img width="297" alt="AttendanceController" src="https://github.com/naoki28aida/stest/assets/138663818/9e105496-c6f6-4d07-9e22-8c690adb8cdf">
<img width="256" alt="ForgotPasswordController" src="https://github.com/naoki28aida/stest/assets/138663818/048617a0-f21b-4175-b663-552b98636c98">
<img width="321" alt="ResetPasswordController" src="https://github.com/naoki28aida/stest/assets/138663818/6d25cd03-23c5-4154-9536-9ec79c830e9e">
<img width="230" alt="AuthenticatedSessionController" src="https://github.com/naoki28aida/stest/assets/138663818/434ed2be-7bcc-4f04-b8b1-11fb06450f0f">
<img width="330" alt="DashboardController" src="https://github.com/naoki28aida/stest/assets/138663818/79f613c3-42f8-4eb9-bcee-042838514ec3">
<img width="320" alt="RegisteredUserController" src="https://github.com/naoki28aida/stest/assets/138663818/6914571c-90b1-4314-95e7-014462e13158">
<img width="291" alt="ResendEmailController" src="https://github.com/naoki28aida/stest/assets/138663818/e206c21b-200c-416e-9d72-69af7464495b">
<img width="172" alt="SimpleResetPasswordMail" src="https://github.com/naoki28aida/stest/assets/138663818/a6a94450-8967-431a-b89e-972b32dbead8">
<img width="191" alt="SimpleVerificationMail" src="https://github.com/naoki28aida/stest/assets/138663818/f7dafcf8-62be-49cd-afdc-7d43f3fc2052">
<img width="284" alt="BreakTime" src="https://github.com/naoki28aida/stest/assets/138663818/33c6bf33-18bc-45ae-911d-a441ce71cc51">
<img width="262" alt="Day" src="https://github.com/naoki28aida/stest/assets/138663818/4a0ca2f0-ae89-41e3-a61d-2a7ca6c8d206">
<img width="241" alt="User" src="https://github.com/naoki28aida/stest/assets/138663818/2d72050c-214a-4cb7-bbe2-f2da36a44ad1">
<img width="283" alt="WorkTime" src="https://github.com/naoki28aida/stest/assets/138663818/9f79002b-a292-45b4-b6fe-6be98c071817">
<img width="414" alt="Route" src="https://github.com/naoki28aida/stest/assets/138663818/1841607e-bf2c-458b-b1a6-ecbed7b6df9f">
<img width="348" alt="forgot-password blade" src="https://github.com/naoki28aida/stest/assets/138663818/a6e7d02b-b5d5-4e00-b5d6-0880ac4caf01">
<img width="367" alt="login blade" src="https://github.com/naoki28aida/stest/assets/138663818/54b48f02-2095-4e3c-9dad-7d5857a80fac">
<img width="423" alt="reset-password blade" src="https://github.com/naoki28aida/stest/assets/138663818/f266e442-b13e-4ddf-a917-f0f9ffa876c3">
<img width="580" alt="attendance blade" src="https://github.com/naoki28aida/stest/assets/138663818/ffe031da-b8e0-4b1a-ac7f-e9ac9e6fc083">
<img width="481" alt="index blade" src="https://github.com/naoki28aida/stest/assets/138663818/7d6919b3-206e-4697-b68b-87ffd45925c5">
<img width="309" alt="staff blade" src="https://github.com/naoki28aida/stest/assets/138663818/0d1f479d-4d60-43d0-8ef1-4dba2fc0c248">
<img width="233" alt="success blade" src="https://github.com/naoki28aida/stest/assets/138663818/0bdca342-9224-4b74-8829-c3550b44c403">
<img width="326" alt="thanks blade" src="https://github.com/naoki28aida/stest/assets/138663818/29b28bbd-fb0b-4a11-9857-6f864f9d70b5">
<img width="399" alt="register blade" src="https://github.com/naoki28aida/stest/assets/138663818/660b41ba-696a-48b3-9168-1dcfb9e1e451">


## 備考
認証メール再送信時、パスワード再設定字のメール内容は、src/resources/views/emails内のファイル2種で変更できます。
