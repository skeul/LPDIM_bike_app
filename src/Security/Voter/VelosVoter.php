<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class VelosVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEWVTT = 'viewVTT';
    const VIEWELECTRIC = 'viewElectric';


    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html

        return in_array($attribute, [SELF::VIEWVTT])
            && $subject instanceof \App\Entity\VTT;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }
        // you know $subject is a Comment object, thanks to `supports()`
        /** @var Velo $velo */
        $velo = $subject;


        switch ($attribute) {
            case self::VIEWVTT:
                return $this->canViewElectic($velo, $user);
            case self::VIEWELECTRIC:
                return $this->canViewVTT($velo, $user);

        }
        throw new \LogicException('This code should not be reached!');
    }

    private function canViewElectic(Electric $velo, User $user)
    {
        // if they can edit, they can view
        if ($velo->getUsers()->contains($user)) {
            return true;
        }

    }
    private function canViewVTT(VTT $velo, User $user)
    {
        // if they can edit, they can view
        if ($velo->getUsers()->contains($user)) {
            return true;
        }

    }
}
