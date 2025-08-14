export type Category = {
	id: number;
	name: string;
	slug: string;
	created_at: Date;
	updated_at: Date;
}

export type Post = {
	id: number;
	user: User;
	url: string;
	slug: string;
	title: string;
	content: string;
	content_to_html: string;
	private: boolean;
	watched: number;
	video_html: string;
	thumbnail_url: string;
	high_thumbnail_url: string;
	category?: number;
	created_at: Date;
	updated_at: Date;
}

export type User = {
	id: number;
	name: string;
	email: string;
	slug: string;
	created_at: Date;
	updated_at: Date;
}

export interface Auth {
	user: User;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
	name: string;
	auth: Auth;
};
