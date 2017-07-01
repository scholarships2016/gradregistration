<?php

namespace App\Repositories\Contracts;

interface AnnouncementRepository {

    public function getAnnouncementAll();

    public function delete($id);

    public function saveAnnouncement($data);
}
