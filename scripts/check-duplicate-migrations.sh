#!/bin/bash
# Fail if any two migration files share the same Y_m_d_His timestamp prefix.
set -euo pipefail

cd "$(dirname "$0")/.."

duplicates=$(ls database/migrations/*.php \
    | xargs -n1 basename \
    | sed -E 's/^([0-9]{4}_[0-9]{2}_[0-9]{2}_[0-9]{6})_.*/\1/' \
    | sort \
    | uniq -d)

if [[ -n "$duplicates" ]]; then
    echo "Duplicate migration timestamps found:"
    echo "$duplicates"
    exit 1
fi

echo "No duplicate migration timestamps found."
