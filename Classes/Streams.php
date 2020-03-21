<?php
// Does magic...

class Streams {
    public function GetStreams($Database) {
        $streamdata = $Database->prepare("SELECT * FROM streams");
        $streamdata->execute();
        while ($streams = $streamdata->fetchObject()) {
            $stream_data[] = $streams;
        }
        return $stream_data;
    }
    public function GetStreamInfo($id, $Database) {
        $streamdata = $Database->prepare("SELECT * FROM streams WHERE id=:id LIMIT 1");
        $streamdata->execute(["id" => $id]);
        while ($streams = $streamdata->fetchObject()) {
            $stream_data[] = $streams;
        }
        return $stream_data;
    }
    public function UpdateStream($id, $stream_name, $stream_description, $stream_username, $stream_embedcode, $stream_enablechat, $Database) {
        $streamupdate = $Database->prepare("UPDATE streams SET name=:name, description=:description, username=:username, embed_code=:embed_code, chat_on=:chat_on WHERE id=:id");
        $streamupdate->execute(["id" => $id, "name" => $stream_name, "description" => $stream_description, "username" => $stream_username, "embed_code" => $stream_embedcode, "chat_on" => $stream_enablechat]);
        return true;
    }
    public function CreateStream($stream_name, $stream_description, $stream_username, $stream_embedcode, $stream_enablechat, $Database) {
        $streamupdate = $Database->prepare("INSERT INTO streams (name, description, username, embed_code, chat_on) VALUES (:name, :description, :username, :embed_code, :chat_on)");
        $streamupdate->execute(["name" => $stream_name, "description" => $stream_description, "username" => $stream_username, "embed_code" => $stream_embedcode, "chat_on" => $stream_enablechat]);
        return true;
    }
    public function DeleteStream($id, $Database) {
        $streamupdate = $Database->prepare("DELETE FROM streams WHERE id=:id");
        $streamupdate->execute(["id" => $id]);
        return true;
    }

    public function CheckIfStreamExists($id, $Database) {
        $stream_exists = $Database->prepare("SELECT name FROM streams WHERE id=:id");
        $stream_exists->execute(["id" => $id]);
        if($stream_exists->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public function GetStreamName($id, $Database) {
        $stream_name = $Database->prepare("SELECT name FROM streams WHERE id=:id LIMIT 1");
        $stream_name->execute(["id" => $id]);
        return $stream_name->fetch()["name"];
    }

    public function StreamEnabledChat($stream_id, $Database) {
        $stream_chat_enabled = $Database->prepare("SELECT chat_on FROM streams WHERE id=:id LIMIT 1");
        $stream_chat_enabled->execute(["id" => $stream_id]);
        return $stream_chat_enabled->fetch()["chat_on"];
    }

}