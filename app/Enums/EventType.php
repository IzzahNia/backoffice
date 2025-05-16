<?php

namespace App\Enums;

enum EventType: string
{
    case CONFERENCE = 'conference';
    case WORKSHOP = 'workshop';
    case WEBINAR = 'webinar';
    case MEETUP = 'meetup';
    case SEMINAR = 'seminar';
    case SYMPOSIUM = 'symposium';
    case EXHIBITION = 'exhibition';
    case FESTIVAL = 'festival';
    case CONCERT = 'concert';
    case COMPETITION = 'competition';
    case CEREMONY = 'ceremony';
    case SUMMIT = 'summit';
    case FORUM = 'forum';
    case PANEL = 'panel';
    case LECTURE = 'lecture';
    case TRAINING = 'training';
    case RETREAT = 'retreat';
    case NETWORKING = 'networking';
    case FAIR = 'fair';
    case LAUNCH = 'launch';
    case PARTY = 'party';
    case GALA = 'gala';
    case SCREENING = 'screening';
    case TOUR = 'tour';
    case PERFORMANCE = 'performance';
}
