<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserVoter extends Voter
{
    const VIEW = 'view_user';
    const EDIT = 'edit_user';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        // only vote on `User` objects
        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a User object, thanks to `supports()`
        /** @var User $user */
        $user1 = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($user1, $user);
            case self::EDIT:
                return $this->canEdit($user1, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(User $user1, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($user, $user)) {
            return true;
        }

        // the User object could have, for example, a method `isPrivate()`
        return false;
    }

    private function canEdit(User $user1, User $user)
    {

        if ($this->security->isGranted('ROLE_ADMIN'))
            return true;
        else
            return $user->getId() === $user1->getId();
    }
}