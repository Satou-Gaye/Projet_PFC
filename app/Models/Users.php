<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Relations\HasOne;
use Illuminate\Database\Relations\HasMany;
use Illuminate\Database\Relations\BelongsTo;

class Users extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'matricule',
        'statut',
        'role',
        'password',
        'departement_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Constantes pour les rôles
    const ADMIN = 'admin';
    const CHEF_DEPARTEMENT = 'chef_departement';
    const CHEF_FILLIERE = 'chef_filliere';
    const ASSISTANT = 'assistant';

    /**
     * Vérifier si l'utilisateur est un administrateur
     */
    public function isAdmin()
    {
        return $this->role === self::ADMIN;
    }

    /**
     * Vérifier si l'utilisateur est un chef de département
     */
    public function isChefDeDepartement()
    {
        return $this->role === self::CHEF_DEPARTEMENT;
    }

    /**
     * Vérifier si l'utilisateur est un chef de filière
     */
    public function isChefDeFilliere()
    {
        return $this->role === self::CHEF_FILLIERE;
    }

    /**
     * Vérifier si l'utilisateur est un assistant
     */
    public function isAssistant()
    {
        return $this->role === self::ASSISTANT;
    }

    /**
     * Vérifier si l'utilisateur a un rôle spécifique
     */
    public function hasRole($roleName)
    {
        return $this->role === $roleName;
    }

    /**
     * Vérifier si l'utilisateur a un des rôles spécifiés
     */
    public function hasAnyRole(array $roles)
    {
        return in_array($this->role, $roles);
    }

    /**
     * Vérifier les permissions selon le rôle
     */
    public function canAccessDashboard()
    {
        return in_array($this->role, [self::ADMIN, self::CHEF_DEPARTEMENT, self::CHEF_FILLIERE, self::ASSISTANT]);
    }

    public function canManageUsers()
    {
        return in_array($this->role, [self::ADMIN, self::CHEF_DEPARTEMENT]);
    }

    public function canCreateUsers()
    {
        return in_array($this->role, [self::ADMIN, self::CHEF_DEPARTEMENT, self::CHEF_FILLIERE]);
    }

    public function canEditUsers()
    {
        return in_array($this->role, [self::ADMIN, self::CHEF_DEPARTEMENT, self::CHEF_FILLIERE]);
    }

    public function canDeleteUsers()
    {
        return $this->role === self::ADMIN;
    }

    public function canViewReports()
    {
        return in_array($this->role, [self::ADMIN, self::CHEF_DEPARTEMENT, self::CHEF_FILLIERE, self::ASSISTANT]);
    }

    public function canExportData()
    {
        return in_array($this->role, [self::ADMIN, self::CHEF_DEPARTEMENT, self::CHEF_FILLIERE]);
    }

    public function canAccessAdminPanel()
    {
        return $this->role === self::ADMIN;
    }

    public function canManageRoles()
    {
        return $this->role === self::ADMIN;
    }

    public function canManageDepartments()
    {
        return in_array($this->role, [self::ADMIN, self::CHEF_DEPARTEMENT]);
    }

    /**
     * Obtenir le nom d'affichage du rôle
     */
    public function getRoleDisplayName()
    {
        $roleNames = [
            self::ADMIN => 'Administrateur',
            self::CHEF_DEPARTEMENT => 'Chef de Département',
            self::CHEF_FILLIERE => 'Chef de Filière',
            self::ASSISTANT => 'Assistant(e)'
        ];

        return $roleNames[$this->role] ?? 'Rôle inconnu';
    }

    /**
     * Relation avec le modèle ChefDeDepartement
     */
    public function chefDepartement()
    {
        return $this->hasOne(Chef_De_Departement::class, 'user_id');
    }

    /**
     * Relation avec le modèle ChefDeFilliere
     */
    public function chefsFillieres()
    {
        return $this->hasMany(Chef_De_Filliere::class, 'user_id');
    }

    /**
     * Relation avec le modèle Assistant
     */
    public function assistantDepartement()
    {
        return $this->hasOne(Assistant_departement::class, 'user_id');
    }

    /**
     * Relation avec le département auquel l'utilisateur appartient
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Scopes pour filtrer les utilisateurs
     */
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeByDepartement($query, $departementId)
    {
        return $query->where('departement_id', $departementId);
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', self::ADMIN);
    }

    public function scopeChefsDepartement($query)
    {
        return $query->where('role', self::CHEF_DEPARTEMENT);
    }

    public function scopeChefsFiliere($query)
    {
        return $query->where('role', self::CHEF_FILLIERE);
    }

    public function scopeAssistants($query)
    {
        return $query->where('role', self::ASSISTANT);
    }

    /**
     * Obtenir le nom complet de l'utilisateur
     */
    public function getFullNameAttribute()
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    /**
     * Vérifier si l'utilisateur peut gérer un autre utilisateur
     */
    public function canManageUser(User $user)
    {
        // Admin peut gérer tout le monde
        if ($this->isAdmin()) {
            return true;
        }

        // Chef de département peut gérer les utilisateurs de son département
        if ($this->isChefDeDepartement() && $this->departement_id === $user->departement_id) {
            return true;
        }

        // Chef de filière peut gérer les utilisateurs de sa filière dans son département
        if ($this->isChefDeFilliere() && $this->departement_id === $user->departement_id) {
            return in_array($user->role, [self::ASSISTANT]);
        }

        return false;
    }
}