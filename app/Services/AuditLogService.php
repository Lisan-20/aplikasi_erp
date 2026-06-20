<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;

class AuditLogService
{
    /**
     * Log an audit action.
     *
     * @param string $action  // e.g., 'create', 'update', 'delete', 'approve'
     * @param string $entity  // model name, e.g., 'permintaan_pembelian'
     * @param int|null $entityId
     * @param \App\Models\User|null $user  // optional, will fallback to Auth::user()
     */
    public static function log(string $action, string $entity, $entityId = null, $user = null)
    {
        try {
            $userId = $user ? $user->id : (Auth::check() ? Auth::id() : null);
            AuditLog::create([
                'action' => $action,
                'entity_type' => $entity,
                'entity_id' => $entityId,
                'user_id' => $userId,
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
            ]);
        } catch (\Exception $e) {
            // Silently ignore to avoid breaking user flow
            logger()->error('AuditLog failed: ' . $e->getMessage());
        }
    }
}
?>
