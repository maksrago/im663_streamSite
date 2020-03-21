<?php


class Chat {

    public function GetMessages($stream_id, $Database) {
        $stream_messages = $Database->prepare("SELECT * FROM chat_messages WHERE stream_id=:id ORDER BY id desc LIMIT 0,10");
        $stream_messages->execute(["id" => $stream_id]);
        while ($streams = $stream_messages->fetchObject()) {
            $stream_msgs[] = $streams;
        }
        return $stream_msgs;
    }

    public function GetMessagesReload($stream_id, $Database) {
        $stream_messages = $Database->prepare("SELECT * FROM chat_messages WHERE stream_id=:id ORDER BY id desc LIMIT 0,10");
        $stream_messages->execute(["id" => $stream_id]);
        return $stream_messages->fetchAll();
    }

    public function SendMessage($message, $user, $stream_id, $Database) {
        $send_message = $Database->prepare("INSERT INTO chat_messages (user, stream_id, message, date) VALUES (:user, :stream_id, :message, :date)");
        $send_message->execute(["user" => $user, "stream_id" => $stream_id, "message" => $message, "date" => date("Y-m-d H:i:s")]);
        return true;
    }
}