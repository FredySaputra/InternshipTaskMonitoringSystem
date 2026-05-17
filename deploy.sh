#!/bin/bash
echo "Building assets..."
npm run build

echo "Creating update zip..."
# Add whatever folders changed
zip -r update.zip \
  app/ \
  resources/ \
  routes/ \
  config/ \
  database/ \
  public/build/ \
  --exclude="*.git*" \
  --exclude="node_modules/*" \
  --exclude="vendor/*"

echo "Done! Upload update.zip to InfinityFree htdocs/laravel/"
