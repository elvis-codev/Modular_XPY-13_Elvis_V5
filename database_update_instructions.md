# Database Migration Instructions

## ✅ ISSUE RESOLVED

The `video_source` column already exists in your database. The migration has been updated to only add the `embed_url` column.

## 1. Run the Migration

```bash
php artisan migrate
```

## 2. Alternative SQL (if migration fails)

If you prefer to run the SQL directly:

```sql
ALTER TABLE `course_module_lessons` 
ADD COLUMN `embed_url` TEXT NULL AFTER `video_id`;
```

## 3. What the Migration Does

- ✅ `video_source` column already exists (stores youtube/vimeo)
- ➕ Adds `embed_url` column (text, nullable) to store embed URLs for PDFs, PPTs, etc.

## 4. How the New Feature Works

### Content Type Dropdown
- **Video**: Shows video source (Youtube/Vimeo) and video link fields
- **Link**: Shows embed URL field for PDFs, PPTs, or other embeddable content

### Database Logic
- When content_type = 'video': `video_source` and `video_id` are populated, `embed_url` is null
- When content_type = 'link': `embed_url` is populated, `video_source` and `video_id` are null

### Form Validation
- Video type requires: video_source, video_id
- Link type requires: embed_url (must be valid URL)

### Preview
- Videos display using the video_id (YouTube/Vimeo embed)
- Links display using the embed_url (PDFs, PPTs, etc.)