<?php

declare(strict_types=1);

namespace App\UI;

use App\Twig\Sidebar\AbstractSidebar;
use App\Twig\Sidebar\SidebarBuilderInterface;
use App\Twig\Sidebar\SidebarCollection;
use App\Twig\Sidebar\Type\SidebarHeader;
use App\Twig\Sidebar\Type\SidebarLink;

/**
 * class MainSidebar.
 *
 * @author bernard-ng <bernard@devscast.tech>
 */
final class MainSidebar extends AbstractSidebar
{
    public function build(SidebarBuilderInterface $builder): SidebarCollection
    {
        return $builder
            ->add(new SidebarHeader('Gestion'))
            ->add(new SidebarLink('admin_event_index', 'Éditions', 'calendar'))
            ->add(new SidebarLink('admin_speaker_index', 'Speakers', 'users'))
            ->add(new SidebarLink('admin_talk_index', 'Talks', 'msg-circle'))
            ->add(new SidebarLink('admin_post_index', 'Articles', 'file-docs'))

            ->add(new SidebarHeader('Paramètres'))
            ->add(new SidebarLink('admin_pricing_index', 'Prix', 'sign-dollar'))
            ->add(new SidebarLink('admin_user_index', 'Administrateur', 'users'))

            ->setTranslationDomain('messages')
            ->create();
    }
}
