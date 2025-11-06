'use client';

import { type ReactNode } from 'react';
import Header from '@/components/core-header';
import Footer from '@/components/core-footer';
import { Head } from '@inertiajs/react';

interface AppLayoutProps {
  children: ReactNode;
}

export default function AppLayout({ children }: AppLayoutProps) {
  return (
    <>
        <Head title="Welcome">
            <link rel="preconnect" href="https://fonts.bunny.net" />
            <link
                href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600"
                rel="stylesheet"
            />
        </Head>
        <div className="flex flex-col min-h-screen">
            <Header />

            <main className="flex-1 container mx-auto px-4 py-6">
            {children}
            </main>

            <Footer />
        </div>
    </>
  );
}
