<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class VelosVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'viewvelo';


    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html

        return in_array($attribute, [SELF::VIEW]);
            //&& $subject instanceof \App\Entity\Velo;
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
            case self::VIEW:
                return $this->canView($velo, $user);
        }
        throw new \LogicException('This code should not be reached!');
    }

    private function canView( $velo, $user)
    {
        // if they can edit, they can view
        if ($velo->getUser() == $user) {
            return true;
        }

    }

}
