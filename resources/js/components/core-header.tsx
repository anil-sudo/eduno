"use client"

import * as React from "react";
import { Menu, Search } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Link, usePage } from '@inertiajs/react';
import { type SharedData } from '@/types';
import { dashboard, login, register } from '@/routes';

import {
  Sheet,
  SheetContent,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet";
import { Input } from "@/components/ui/input";
import {
  NavigationMenu,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
  NavigationMenuContent,
} from "@/components/ui/navigation-menu";
import AppLogo from "@/components/app-logo";

function ListItem({ title, href, children }: {title: any, href: any, children: any}) {
  return (
    <li>
      <NavigationMenuLink asChild>
        <Link
          href={href}
          className="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent"
        >
          <div className="text-sm font-medium leading-none">{title}</div>
          <p className="line-clamp-2 text-sm leading-snug text-muted-foreground">
            {children}
          </p>
        </Link>
      </NavigationMenuLink>
    </li>
  )
}


const semesters = [
  {
    title: "Entrance",
    href: "/entrance",
    desc: "Prepare for entrance exams with past papers, tips, and strategy guides.",
  },
  {
    title: "1st Semester",
    href: "/semesters/1",
    desc: "Fundamentals of programming, mathematics, and digital logic resources.",
  },
  {
    title: "2nd Semester",
    href: "/semesters/2",
    desc: "Detailed notes and problem sets on data structures and microprocessors.",
  },
  {
    title: "3rd Semester",
    href: "/semesters/3",
    desc: "Resources on object-oriented programming, algorithms, and electronics.",
  },
  {
    title: "4th Semester",
    href: "/semesters/4",
    desc: "Database systems, operating systems, and numerical methods materials.",
  },
  {
    title: "5th Semester",
    href: "/semesters/5",
    desc: "Software engineering, computer networks, and system analysis resources.",
  },
  {
    title: "6th Semester",
    href: "/semesters/6",
    desc: "Compiler design, artificial intelligence, and web technology notes.",
  },
  {
    title: "7th Semester",
    href: "/semesters/7",
    desc: "Distributed systems, network security, and project management materials.",
  },
  {
    title: "8th Semester",
    href: "/semesters/8",
    desc: "Final year project reports, research guides, and advanced electives.",
  },
];

export default function Header() {
    const [open, setOpen] = React.useState(false)
    const { auth } = usePage<SharedData>().props;

    const renderDropdown = (section: any) => (
        <NavigationMenuItem>
            <NavigationMenuTrigger>{section}</NavigationMenuTrigger>
            <NavigationMenuContent>
                <ul className="grid gap-2 md:w-[500px] lg:w-[700px] lg:grid-cols-[.75fr_1fr]">
                    <li className="row-span-3">
                        <NavigationMenuLink asChild>
                        <Link
                            href={`/${section.toLowerCase().replace(" ", "-")}`}
                            className="from-muted/50 to-muted flex h-full w-full flex-col justify-end rounded-md bg-gradient-to-b p-4 no-underline outline-hidden transition-all duration-200 select-none focus:shadow-md md:p-6"
                        >
                            <div className="mb-2 text-lg font-medium sm:mt-4">
                            {section}
                            </div>
                            <p className="text-muted-foreground text-sm leading-tight">
                            Explore all {section.toLowerCase()} materials and semester-wise resources.
                            </p>
                        </Link>
                        </NavigationMenuLink>
                    </li>

                    {semesters.map((item) => (
                        <ListItem
                        key={item.title}
                        title={item.title}
                        href={`/${section.toLowerCase().replace(" ", "-")}${item.href}`}
                        >
                        {item.desc}
                        </ListItem>
                    ))}
                </ul>
            </NavigationMenuContent>
        </NavigationMenuItem>
    );
  return (
    <header className="sticky top-0 z-50 w-full border-b bg-background/80 backdrop-blur-sm">
      <div className="container mx-auto flex h-16 items-center justify-between px-4">
        <div className="flex items-center space-x-2">
          <Link href="/">
              <AppLogo />
          </Link>
        </div>

        <div className="hidden md:flex items-center space-x-6">
            <NavigationMenu>
                <NavigationMenuList>
                {["Notes", "Solution", "MCQ", "Board Question"].map((section) =>
                    renderDropdown(section)
                )}
                </NavigationMenuList>
            </NavigationMenu>
        </div>

        <div className="hidden md:flex items-center space-x-3">
            <div className="relative">
                <Search className="absolute left-2 top-2.5 h-4 w-4 text-muted-foreground" />
                <Input
                    type="text"
                    placeholder="Search..."
                    className="pl-8 w-40 md:w-56"
                />
            </div>
            {auth.user ? (
                <Link
                    href={dashboard()}
                    className="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
            ) : (
                <>
                    <Link
                        href={login()}
                        className="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        href={register()}
                        className="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </>
            )}
        </div>

        <div className="md:hidden">
          <Sheet open={open} onOpenChange={setOpen}>
            <SheetTrigger asChild>
              <Button variant="ghost" size="icon">
                <Menu className="h-5 w-5" />
              </Button>
            </SheetTrigger>
            <SheetContent side="right" className="w-64">
              <SheetHeader>
                <SheetTitle>Menu</SheetTitle>
              </SheetHeader>
              <nav className="mt-6 flex flex-col space-y-4 px-4">
                <Link
                  href="/"
                  className="text-sm font-medium hover:text-foreground"
                  onClick={() => setOpen(false)}
                >
                  Home
                </Link>
                <Link
                  href="/about"
                  className="text-sm font-medium hover:text-foreground"
                  onClick={() => setOpen(false)}
                >
                  About
                </Link>
                <Link
                  href="/contact"
                  className="text-sm font-medium hover:text-foreground"
                  onClick={() => setOpen(false)}
                >
                  Contact
                </Link>
                <div className="pt-4 border-t">
                  {auth.user ? (
                        <Link
                            href={dashboard()}
                            className="w-full inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                        >
                            Dashboard
                        </Link>
                    ) : (
                        <>
                            <Link
                                href={login()}
                                className="w-full inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                            >
                                Log in
                            </Link>
                            <Link
                                href={register()}
                                className="w-full inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                            >
                                Register
                            </Link>
                        </>
                    )}
                </div>
              </nav>
            </SheetContent>
          </Sheet>
        </div>
      </div>
    </header>
  )
}
