import { Toaster } from '@/components/ui/sonner';
import { Head } from '@inertiajs/react';

interface GuestLayoutProps {
    children: React.ReactNode;
    title: string;
}

function GuestLayout({ children, title }: GuestLayoutProps) {
    return (
        <div>
            <Head title={title} />
            <main className="flex flex-col gap-5 p-5">
                {children}
                <Toaster position="top-right" expand={true} richColors />
            </main>
        </div>
    );
}

export default GuestLayout;
