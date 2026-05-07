# Oh! It's another WordPress Boilerplate!
All core files within are related to the default WordPress core install from Azure. If you would like to setup your own instance in Azure and locally, please refer to these documents:
- <a href="https://enviroissues.sharepoint.com/:w:/r/sites/development/_layouts/15/Doc2.aspx?action=edit&sourcedoc=%7B00f1a6af-f6be-426b-9e98-986d34e4f807%7D&wdOrigin=TEAMS-MAGLEV.teamsSdk_ns.rwc&wdExp=TEAMS-TREATMENT&wdhostclicktime=1712774974720&web=1" target="_blank">Set up Wordpress Site on Azure</a>
- <a href="https://enviroissues-my.sharepoint.com/:w:/r/personal/bbogard_enviroissues_com/_layouts/15/Doc2.aspx?action=edit&sourcedoc=%7B1610baa9-2a37-4c33-9bed-2d88a9c267bd%7D&wdOrigin=TEAMS-MAGLEV.undefined_ns.rwc&wdExp=TEAMS-TREATMENT&wdhostclicktime=1712775039058&web=1" target="_blank">Set up a lando site</a>
- <a href="https://enviroissues.sharepoint.com/:w:/r/sites/development/_layouts/15/Doc2.aspx?action=edit&sourcedoc=%7Bc17e6e34-68bf-4312-9fbb-c483c132afc0%7D&wdOrigin=TEAMS-MAGLEV.teamsSdk_ns.rwc&wdExp=TEAMS-TREATMENT&wdhostclicktime=1711587738925&web=1" target="_blank">Set up Github Actions on Azure</a>

## Environments
- <a href="https://sandbox-wp-staging.azurewebsites.net/" target="_blank">stage</a>
- <a href="https://sandbox-wp.azurewebsites.net/" target="_blank">prod</a> (Azure automatically creates two environments)
- <a href="https://portal.azure.com/#@enviroissues.com/resource/subscriptions/c3da5916-e4b0-4544-b3cb-af8b89c2b882/resourceGroups/Wordpress/providers/Microsoft.Web/sites/sandbox-wp/appServices" target="_blank">Azure portal</a>

## Development
- This boilerplate is ready to go with lando HOWEVER, before starting a new project, you need to rename your lando instance from 'sandbox-wp' to whatever your project is called. If you do not do this, you will use the sandbox-wp database on your local which may cause problems. In the near future, we will change this to a < placeholder > and force you to make the change when after the initial clone and project setup.
- Within wp-content/themes/ we have our boilerplate theme, 'skookum' this is set up for scss compilation.
- For local development run: </br>
nvm use v22 </br>
npm install </br>
npm run dev </br>
- We are using Github Actions to deploy compiled styles and updates to azure. See documentation above.

## Plugins
Plugins which may be on the Azure instance install but should NOT be on your local are:
- Akismet (delete)
- App Service Email (deactivate during development)
- W3 Total Cache (deactivate during development)

Plugins which we need on every project:
- ACF Pro
- Smush
- Yoast
- Safe Redirect Manager

## Handling Updates
We will version control the WordPress core updates (automatic updates are tunred off in wp-config.php) and the plugin updates. However we are only deploying the wp-content folder. This means that updating Wordpress core needs to happen within the CMS itself on the stage and prod instances individually. 

### To update WP Core
- Create new branch on local using this naming convention, 'core-update_VERSION-NUMBER'
- Update local WP version in your CMS
- Push up core update with a single commit
- Make PR to stage

### To update Plugins
- Create new branch on local using this naming convention, 'plugin-update-PLUGIN-NAME_PLUGIN-VERSION-NUMBER'
- Update local plugin on your local within the CMS
- Push up plugin update with a single commit
- Make PR to stage
- Upon merge, the plugin update will be pushed to the stage environment and continue with our usual code workflow

## Branching structure
update-* > stage </br>
feature-* > stage </br>
issue-* > stage </br>
bug-* > feature-* > stage </br>
stage > main </br>
core-update_VERSION-NUMBER </br>
plugin-update-PLUGIN-NAME_PLUGIN-VERSION-NUMBER </br>
