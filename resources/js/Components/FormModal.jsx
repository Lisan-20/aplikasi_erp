import React from 'react';
import { X } from 'lucide-react';

export default function FormModal({ isOpen, onClose, title, icon, onSubmit, children }) {
    if (!isOpen) return null;

    return (
        <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
            <div className="bg-white dark:bg-slate-800 rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
                <div className="flex items-center justify-between p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                    <div className="flex items-center space-x-2">
                        {icon}
                        <h2 className="text-lg font-semibold text-slate-800 dark:text-white">{title}</h2>
                    </div>
                    <button 
                        onClick={onClose}
                        className="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 p-1 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors"
                    >
                        <X size={20} />
                    </button>
                </div>
                <form onSubmit={onSubmit}>
                    <div className="p-5 max-h-[70vh] overflow-y-auto">
                        {children}
                    </div>
                    <div className="flex justify-end space-x-3 p-4 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                        <button
                            type="button"
                            onClick={onClose}
                            className="dash-btn secondary"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            className="dash-btn primary"
                        >
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
}
