# Creating a Gutenberg Block with ACF

## 1. Register the Block

Each block requires the following files and configuration:

1. Create a new folder inside `/acf-blocks/` named after your block.
2. Inside that folder, create a `block.json` file for the block registration. Copy an existing `block.json` as a starting point and update the relevant fields (e.g., `name`, `title`, `description`).
3. In the same folder, create a `.php` file using the block name in **kebab-case**. This file contains the block's markup/template.
4. Create a new `.scss` file using the block name in **kebab-case**, with the block name as the main class wrapper. Then import it into `style.scss`.
5. Add the new block to `/inc/block-list.php` inside the `skookum_allowed_block_types` function.

## 2. Create the Field Group

1. In the CMS, create a new ACF field group with the fields your block needs.
2. In the field group settings (at the bottom of the page), set the **Location Rules** to: **Block** → **is equal to** → _your new block_.
3. When you create or modify a field group in the CMS, ACF generates a `.json` file in `/acf-json/` with a timestamp as the filename. After it's generated:
   - Rename the file to the block name in **kebab-case**.
   - Update the `key` attribute to follow this convention:
     - Group: `group-{block_name}`
     - Fields: `field-{block_name}_{field_name}`
   - Update the `name` attribute to: `{block_name}_{field_name}`
4. Delete the ACF field group from the CMS to avoid potential conflicts.

> **Note:** Editing fields in the CMS after renaming will generate a new timestamped file. To avoid having to rename again, edit the JSON file directly whenever possible.

## 3. Test the Block

1. Navigate to a page on your local environment.
2. Confirm the new block appears in the block library.
3. Add the block, fill in the fields with various settings, and save the page.
4. Verify the block renders correctly on the front end and in the editor.
